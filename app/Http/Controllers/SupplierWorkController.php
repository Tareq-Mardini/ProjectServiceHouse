<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\services;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Work;

class SupplierWorkController extends Controller
{
  //عرض جميع الاعمال
  public function ViewWorks() {
    $data = Work::all();
    return view('Supplier.Home.Works.Works', compact('data'));
  }


  //عرض اعمال المقدم
  public function ViewMyWork()  {
    $userId = session('supplier_user_id');
    $works = Work::where('supplier_id', $userId)->get();
    return view('Supplier.Home.Works.Myworks', compact('works'));
  }



  //عرض تفاصيل العمل
  public function ViewWorkInfo($id) {
    $works = Work::find($id);
    return view('Supplier.Home.Works.WorkInfo', compact('works'));
  }



  //انشاء
  public function CreateWork()  {
    $data = services::all();
    return view('Supplier.Home.Works.Create', compact('data'));
  }


  
  //تخزين
  public function StoreWork(Request $request) {
    $validator = $request->validate([
      'service_id' => 'required|integer|exists:services,id',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'price' => 'required|numeric',
      'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      'youtube_link' => 'nullable|url',

    ],);
    $imagePath = $request->file('thumbnail')->store('images/works', 'public');

    $userId = session('supplier_user_id');
    Work::create([
      'service_id' => $request->input('service_id'),
      'supplier_id' => $userId,
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'price' => $request->input('price'),
      'thumbnail' => $imagePath,
      'youtube_link' => $request->input('youtube_link'),
    ]);

    session()->flash('success', 'Success create work.');
    return redirect()->route('Supplier.Show.Myworks');
  }



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
    ]);
    
    $work->service_id = $request->service_id;
    $work->title = $request->title;
    $work->description = $request->description;
    $work->price = $request->price;
    $work->save();

    session()->flash('success_update_work', 'Success update work.');
    return redirect()->route('Supplier.Show.Myworks');
  }



  public function DeleteWork($id)
  {
    $work = work::find($id);
    $work->forceDelete();
    session()->flash('success_delete_work', 'Success Delete work.');
    return redirect()->route('Supplier.Show.Myworks');
  }
}
