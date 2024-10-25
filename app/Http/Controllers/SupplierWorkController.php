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
        $userId = session('supplier_user_id');
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
    public function StoreWork(Request $request){

         $validator = $request->validate([
            'service_id'=> 'required|integer|exists:services,id',
            'supplier_id'=>'required|integer|exists:supplier,id',
            'title'=>'required|string|max:255',
            'description' => 'required|string',
            'price'=> 'required|numeric',
            'image'=>'required|nullable|mimes:png,jpg,jpeg,webp',
            'attachments' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ],);
       
        $path ="";
        $filename="";
        $file="";

        $path1 ="";
        $filename1="";
        $file1="";
        if($request->has('image')){
            $file = $request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uplod/images/';
            $file->move($path,$filename);
        }else{
            if($filename === 'c:\Users\DELL\Desktop\mob\pic\495460.png');
        }

        if($request->has('attachments')){
            $file1 = $request->file('attachments');
            $extension =$file1->getClientOriginalExtension();
            $filename1 = time().'.'.$extension;
            $path1 = 'uplod/images/';
            $file->move($path1,$filename1);
        }else{
            if($filename1 === 'c:\Users\DELL\Desktop\mob\pic\495460.png');
        }

        $userId = session('supplier_user_id');
        Work::create([
            'service_id'=>$request->input('service_id'),
            'supplier_id' => $userId ,
            'title' => $request->input('title'),
            'description'=> $request->input('description'),
            'price'=> $request->input('price'),
            'image'=> $path.$filename,
            'attachments'=> $path1.$filename1
        ]);
    
        session()->flash('success', 'Success create work.');
        return redirect()->route('Supplier.Show.Myworks');
}
}