<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\services;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Work;
use App\Models\WorkImage;

//========================================================================================

class SupplierWorkController extends Controller
{
  //عرض جميع الاعمال
  public function ViewWorks()
  {
    $data = Work::all();
    return view('Supplier.Home.Works.Works', compact('data'));
  }
  //========================================================================================
  //عرض اعمال المقدم
  public function ViewMyWork()
  {
    $userId = session('supplier_user_id');
    $works = Work::where('supplier_id', $userId)->get();
    return view('Supplier.Home.Works.Myworks', compact('works'));
  }
  //========================================================================================
  //عرض تفاصيل العمل
  public function ViewWorkInfo(Request $request)
  {
    $userId = session('supplier_user_id');
    $works = Work::where('supplier_id', $userId)
      ->where('id', $request->id)
      ->first();
      $id_service=$works->service_id;
      $name_service = services::where('id',$id_service)->first('name');
      $image =WorkImage::where('work_id',$request->id)->get('image_path');
    return view('Supplier.Home.Works.WorkInfo', compact('works','name_service','image'));
  }
  //========================================================================================
  public function CreateWork()
  {
    $data = services::all();
    return view('Supplier.Home.Works.Create', compact('data'));
  }
  //========================================================================================
  public function StoreWork(Request $request)
  {
    $validator = $request->validate([
      'service_id' => 'required|integer|exists:services,id',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'price' => 'required|numeric',
      'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'youtube_link' => 'nullable|url',
      'Average_delivery_time' => 'nullable|string',
      'Average_speed_of_response' => 'nullable|string'
    ]);
    $imagePath = $request->file('thumbnail')->store('images/works', 'public');
    $userId = session('supplier_user_id');
    $work = Work::create([
      'service_id' => $request->input('service_id'),
      'supplier_id' => $userId,
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'price' => $request->input('price'),
      'thumbnail' => $imagePath,
      'youtube_link' => $request->input('youtube_link'),
      'Average_delivery_time' => $request->input('Average_delivery_time'),
      'Average_speed_of_response' => $request->input('Average_speed_of_response'),
    ]);
    if ($request->hasFile('images')) {
      foreach ($request->file('images') as $image) {
        $path = $image->store('images/works/multiple', 'public');
        $work->images()->create(['image_path' => $path]);
      }
    }
    session()->flash('success', 'تم إنشاء العمل بنجاح.');
    return redirect()->route('Supplier.Show.Myworks');
  }
  //========================================================================================
  public function EditeWork(Request $request)
  {
    $id = $request->input('id');
    $work = Work::findOrFail($id);
    if ($work->supplier_id != session('supplier_user_id')) {
      return redirect()->route('Supplier.Show.Myworks')->withErrors(['message' => 'Unauthorized action.']);
    }
    $work_Service = services::all();
    return view('Supplier.Home.Works.Update', compact('work', 'work_Service'));
  }
  //========================================================================================
  public function UpdateWork(Request $request, $id)
  {
    $work = Work::findOrFail($id);
    if ($work->supplier_id != session('supplier_user_id')) {
      return redirect()->route('Supplier.Show.Myworks')->withErrors(['message' => 'Unauthorized action.']);
    }
    $request->validate([
      'service_id' => 'required|integer|exists:services,id',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'price' => 'required|numeric',
      'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'youtube_link' => 'nullable|url',
      'Average_delivery_time' => 'nullable|string',
      'Average_speed_of_response' => 'nullable|string'
    ]);
    $work->service_id = $request->input('service_id');
    $work->title = $request->input('title');
    $work->description = $request->input('description');
    $work->price = $request->input('price');
    $work->youtube_link = $request->input('youtube_link');
    $work->Average_delivery_time = $request->input('Average_delivery_time');
    $work->Average_speed_of_response = $request->input('Average_speed_of_response');
    // هون دخلت صورة مصغرة جديدة بشوف اي او لا 
    if ($request->hasFile('thumbnail')) {
      // حذف الصورة المصغرة القديمة
      Storage::disk('public')->delete($work->thumbnail);
      // تخزين الصورة المصغرة الجديدة
      $work->thumbnail = $request->file('thumbnail')->store('images/works', 'public');
      $work->save();
    }
    // هون بشوف في صورة جديدة او لا 
    if ($request->hasFile('images')) {
      // حذف الصور القديمة من التخزين وقاعدة البيانات
      foreach ($work->images as $oldImage) {
        Storage::disk('public')->delete($oldImage->image_path);
        $oldImage->delete();
      }
      // إضافة الصور الجديدة
      foreach ($request->file('images') as $image) {
        $path = $image->store('images/works/multiple', 'public');
        $work->images()->create(['image_path' => $path]);
      }
    }
    $work->save();
    session()->flash('success_update_work', 'تم تحديث العمل بنجاح.');
    return redirect()->route('Supplier.Show.Myworks');
  }
  //========================================================================================
  public function DeleteWork($id)
  {
    $work = Work::find($id);
    if ($work) {
      // حذف الصورة الأساسية
      if ($work->thumbnail) {
        Storage::disk('public')->delete($work->thumbnail);
      }
      foreach ($work->images as $image) {
        Storage::disk('public')->delete($image->image_path);
        $image->delete(); // حذف السجل المرتبط بالصورة من قاعدة البيانات
      }
      $work->forceDelete();
      session()->flash('success_delete_work', 'Success Delete work.');
    } else {
      session()->flash('error_delete_work', 'Work not found.');
    }
    return redirect()->route('Supplier.Show.Myworks');
  }
}
  //========================================================================================
