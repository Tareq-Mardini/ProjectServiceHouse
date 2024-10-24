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
    public function ViewMyWork(){
        $userId = session('user_id');
        $supplier = Supplier::findOrFail($userId);
        $works = $supplier->works;
        return view('Supplier.Home.Works.Myworks', compact('works'));
    }
    //انشاء
    public function CreateWork(){
        $data = services::all(); 
        return view('Supplier.Home.Works.Create',compact('data'));
    }
    //تخزين
    public function StoreWork(Request $request , services $serviceId){

         $validator = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'attachment' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', 
            'service_id' => 'required|integer|exists:services,id', 
            'section_id' => 'required|integer|exists:sections,id', 
        ],);
       
        $path = $request->file('image')->store('images', 'public');

        if($request->has('Attachment')){
            $file = $request->file('Attachment');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uplod/images/';
            $file->move($path,$filename);

        Work::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'attachment' => $path,
            'service_id' => $request->input('service_id'),
            'section_id' => $request->input('section_id'),
        ]);
    
        session()->flash('success', 'Success create work.');
        return redirect()->route('Works.Show.Supplier', compact('serviceId'));
    }
}
}