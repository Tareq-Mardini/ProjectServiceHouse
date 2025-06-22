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
use Illuminate\Support\Facades\Http;


//========================================================================================

class SupplierWorkController extends Controller
{

  //========================================================================================
  public function ViewMyWork()
  {
    $userId = session('supplier_user_id');
    $works = Work::where('supplier_id', $userId)->get();
    return view('Supplier.Home.Works.Myworks', compact('works'));
  }
  //========================================================================================
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
    $request->validate([
      'service_id' => 'required|integer|exists:services,id',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'price' => 'required|numeric|min:3',
      'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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

    $thumbnail = $request->file('thumbnail');
    $apiKey = config('services.aiornot.key');

    $response = Http::timeout(6000)->withHeaders([
      'Authorization' => "Bearer $apiKey",
    ])->attach(
      'object',
      file_get_contents($thumbnail),
      $thumbnail->getClientOriginalName()
    )->post("https://api.aiornot.com/v1/reports/image");

    if ($response->status() === 429) {
      return back()->withErrors(['thumbnail' => '❌ You have reached the free image analysis limit.'])->withInput();
    }

    if ($response->status() === 403 || $response->failed()) {
      return back()->withErrors(['thumbnail' => '⚠️ Error analyzing the thumbnail image. Please try again later.'])->withInput();
    }

    $result = $response->json();
    if (($result['report']['ai']['is_detected'] ?? false) === true) {
      return back()->withErrors(['thumbnail' => '❌ The image appears to be generated by AI. Please upload a real image.'])->withInput();
    }

    $imagePath = $request->file('thumbnail')->store('images/works', 'public');
    $userId = session('supplier_user_id');

    $TestWallet = Wallet::where('user_id', $userId)->where('role', 'supplier')->first();
    if (!$TestWallet) {
      session()->flash('error_Create', 'You need to create a wallet first.');
      return redirect()->back();
    }

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

    session()->flash('Success_Create', 'Work has been created successfully.');
    return redirect()->route('Supplier.Show.Myworks');
  }

  //========================================================================================
  public function EditeWork($id)
  {
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
      return redirect()->route('Supplier.Show.Myworks')
        ->withErrors(['message' => 'Unauthorized action.']);
    }

    $request->validate([
      'service_id' => 'required|integer|exists:services,id',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'price' => 'required',
      'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'youtube_link' => 'nullable|url',
      'Average_delivery_time' => 'nullable|string',
      'Average_speed_of_response' => 'nullable|string',
    ], [
      'service_id.required' => 'Service is required.',
      'title.required' => 'Title is required.',
      'description.required' => 'Description is required.',
      'price.required' => 'Price is required.',
      'thumbnail.image' => 'Thumbnail must be an image.',
      'thumbnail.mimes' => 'Thumbnail must be jpeg, png, jpg, or gif.',
      'thumbnail.max' => 'Thumbnail must not exceed 2MB.',
      'images.*.image' => 'Each additional image must be a valid image.',
      'images.*.mimes' => 'Images must be jpeg, png, jpg, or gif format.',
      'images.*.max' => 'Each image must not exceed 2MB.',
      'youtube_link.url' => 'The YouTube link must be a valid URL.',
    ]);

    if ($request->hasFile('thumbnail')) {
      $thumbnail = $request->file('thumbnail');
      $apiKey = config('services.aiornot.key');

      $response = Http::timeout(3000)->withHeaders([
        'Authorization' => "Bearer $apiKey",
      ])->attach(
        'object',
        file_get_contents($thumbnail),
        $thumbnail->getClientOriginalName()
      )->post("https://api.aiornot.com/v1/reports/image");

      if ($response->status() === 429) {
        return back()->withErrors(['thumbnail' => 'You have reached the free image analysis limit.'])->withInput();
      }

      if ($response->status() === 403 || $response->failed()) {
        return back()->withErrors(['thumbnail' => 'Error analyzing the thumbnail image. Please try again later.'])->withInput();
      }

      $result = $response->json();
      if (($result['report']['ai']['is_detected'] ?? false) === true) {
        return back()->withErrors(['thumbnail' => 'The image appears to be generated by AI. Please upload a real image.'])->withInput();
      }
    }

    $work->update([
      'service_id' => $request->input('service_id'),
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'price' => $request->input('price'),
      'youtube_link' => $request->input('youtube_link'),
      'Average_delivery_time' => $request->input('Average_delivery_time'),
      'Average_speed_of_response' => $request->input('Average_speed_of_response'),
    ]);

    if ($request->hasFile('thumbnail')) {
      Storage::disk('public')->delete($work->thumbnail);
      $work->thumbnail = $request->file('thumbnail')->store('images/works', 'public');
      $work->save();
    }

    if ($request->hasFile('images')) {
      foreach ($work->images as $oldImage) {
        Storage::disk('public')->delete($oldImage->image_path);
        $oldImage->delete();
      }

      foreach ($request->file('images') as $image) {
        $path = $image->store('images/works/multiple', 'public');
        $work->images()->create(['image_path' => $path]);
      }
    }

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
      if ($work->thumbnail) {
        Storage::disk('public')->delete($work->thumbnail);
      }
      foreach ($work->images as $image) {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
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
