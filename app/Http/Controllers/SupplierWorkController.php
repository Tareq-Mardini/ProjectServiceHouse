<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\services;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Work;
use App\Models\WorkExtra;
use App\Models\WorkImage;
use App\Models\Review;

//========================================================================================

class SupplierWorkController extends Controller
{


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
    $id_service = $works->service_id;
    $name_service = services::where('id', $id_service)->first('name');
    $image = WorkImage::where('work_id', $request->id)->get('image_path');
    $offers = WorkExtra::where('work_id', $request->id)->get();
    $reviews = Review::with('client') // العلاقة مع الزبون
      ->where('work_id', $works->id)
      ->latest()
      ->get();
    return view('Supplier.Home.Works.WorkInfo', compact('works', 'name_service', 'image', 'offers', 'reviews'));
  }
  //========================================================================================
  public function CreateWork()
  {
    $userId = session('supplier_user_id');
    $TestWallet = Wallet::where('user_id', $userId)
      ->where('role', 'supplier')->first();
    if ($TestWallet) {
      $data = services::all();
      return view('Supplier.Home.Works.Create', compact('data'));
    } else {
      session()->flash('error_Create', 'you have create wallet');
      return redirect()->back();
    }
  }
  //========================================================================================
  public function StoreWork(Request $request)
  {
    $validator = $request->validate([
      'service_id' => 'required|integer|exists:services,id',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'price' => 'required|numeric|min:3',
      'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'youtube_link' => 'nullable|url',
      'Average_delivery_time' => 'nullable|string',
      'Average_speed_of_response' => 'nullable|string',
      'extras.*.title' => 'nullable|string|max:255',
      'extras.*.price' => 'nullable|numeric|min:1',
    ], [
      'service_id.required' => 'Service is required.',
      'service_id.integer' => 'Service ID must be a valid number.',
      'service_id.exists' => 'The selected service does not exist.',

      'title.required' => 'Title is required.',
      'title.string' => 'Title must be a valid string.',
      'title.max' => 'Title must not exceed 255 characters.',

      'description.required' => 'Description is required.',

      'price.required' => 'Price is required.',
      'price.numeric' => 'Price must be a valid number.',
      'price.min' => 'Price must be at least $3.',

      'thumbnail.required' => 'Thumbnail image is required.',
      'thumbnail.image' => 'Thumbnail must be an image.',
      'thumbnail.mimes' => 'Thumbnail must be a jpeg, png, jpg, or gif file.',
      'thumbnail.max' => 'Thumbnail must not exceed 2MB.',

      'images.*.image' => 'Each additional image must be a valid image.',
      'images.*.mimes' => 'Images must be jpeg, png, jpg, or gif format.',
      'images.*.max' => 'Each image must not exceed 2MB.',

      'youtube_link.url' => 'The YouTube link must be a valid URL.',

      'extras.*.title.string' => 'Each extra title must be a valid string.',
      'extras.*.title.max' => 'Extra title must not exceed 255 characters.',

      'extras.*.price.numeric' => 'Each extra price must be a number.',
      'extras.*.price.min' => 'Each extra price must be at least $1.',
    ]);

    $imagePath = $request->file('thumbnail')->store('images/works', 'public');
    $userId = session('supplier_user_id');
    $TestWallet = Wallet::where('user_id', $userId)
      ->where('role', 'supplier')->first();
    if ($TestWallet) {
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

      if ($request->has('extras')) {
        foreach ($request->input('extras') as $extra) {
          if (!empty($extra['title']) && isset($extra['price'])) {
            $work->extras()->create([
              'title' => $extra['title'],
              'price' => $extra['price'],
            ]);
          }
        }
      }

      session()->flash('Success_Create', 'Success Create Work');
      return redirect()->route('Supplier.Show.Myworks');
    } else {
      session()->flash('error_Create', 'you have create wallet');
      return redirect()->back();
    }
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
    $request->validate(
      [
        'service_id' => 'required|integer|exists:services,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'youtube_link' => 'nullable|url',
        'Average_delivery_time' => 'nullable|string',
        'Average_speed_of_response' => 'nullable|string'
      ],
      [
        'service_id.required' => 'Service is required.',
        'service_id.integer' => 'Service ID must be a valid number.',
        'service_id.exists' => 'The selected service does not exist.',

        'title.required' => 'Title is required.',
        'title.string' => 'Title must be a valid string.',
        'title.max' => 'Title must not exceed 255 characters.',

        'description.required' => 'Description is required.',

        'price.required' => 'Price is required.',
        'price.numeric' => 'Price must be a valid number.',
        'price.min' => 'Price must be at least $3.',

        'thumbnail.required' => 'Thumbnail image is required.',
        'thumbnail.image' => 'Thumbnail must be an image.',
        'thumbnail.mimes' => 'Thumbnail must be a jpeg, png, jpg, or gif file.',
        'thumbnail.max' => 'Thumbnail must not exceed 2MB.',

        'images.*.image' => 'Each additional image must be a valid image.',
        'images.*.mimes' => 'Images must be jpeg, png, jpg, or gif format.',
        'images.*.max' => 'Each image must not exceed 2MB.',

        'youtube_link.url' => 'The YouTube link must be a valid URL.',
      ]
    );

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
    session()->flash('Success_Update', 'Success Update Work');
    return redirect()->route('Supplier.Show.Myworks');
  }
  //========================================================================================
  public function DeleteWork($id)
  {
    $work = Work::find($id);
    $TestOrder = Order::where('work_id', $id)
      ->whereNot('order_status', 'approved')
      ->first();
    if ($TestOrder) {
      session()->flash('error_delete_work_order', 'There is an order associated with this work that has not been completed yet.');
      return redirect()->back();
    }
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
      session()->flash('Success_Delete', 'Success Delete Work');
    } else {
      session()->flash('error_delete_work', 'Work not found.');
    }
    return redirect()->route('Supplier.Show.Myworks');
  }
}
  //========================================================================================
