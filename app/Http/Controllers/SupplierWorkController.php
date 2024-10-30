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
        $works = Work::where('supplier_id',$userId)->get();
        return view('Supplier.Home.Works.Myworks', compact('works'));
    }
    //عرض تفاصيل العمل
    public function ViewWorkInfo($id){
        $works = Work::find($id);
        return view('Supplier.Home.Works.WorkInfo', compact('works'));
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
            'title'=>'required|string|max:255',
            'description' => 'required|string',
            'price'=> 'required|numeric',
            
        ],);
       
        $userId = session('supplier_user_id');
        Work::create([
            'service_id'=>$request->input('service_id'),
            'supplier_id' => $userId ,
            'title' => $request->input('title'),
            'description'=> $request->input('description'),
            'price'=> $request->input('price'),
        ]);
    
        session()->flash('success', 'Success create work.');
        return redirect()->route('Supplier.Show.Myworks');
    }

    public function EditeWork($id){
        $work = Work::find($id);
        $work_Service=services::all();
        return view('Supplier.Home.Works.Update',compact('work','work_Service'));
    }

    public function UpdateWork(Request $request, $id){
        $work=Work::find($id);

        $userId = session('supplier_user_id');
        $request->validate([
            
            'service_id'=> 'required|integer|exists:services,id',
            'supplier_id'=> '$userId',
            'title'=>'required|string|max:255',
            'description' => 'required|string',
            'price'=> 'required|numeric',
        ],
        [
            'name.unique' => 'The work already exists'
        ]);

        $work->service_id = $request->service_id;
        $work->supplier_id = $request->supplier_id;
        $work->title = $request->title;
        $work->description = $request->description;
        $work->price = $request->price;
        $work->save();
        
        session()->flash('success_update_work','Success update work.');
        return redirect()->route('Supplier.Show.Myworks');
    }
    public function DeleteWork($id){
        $work = work::find($id);
        $work->forceDelete();
        session()->flash('success_delete_work', 'Success Delete work.');  
        return redirect()->route('Supplier.Show.Myworks');
    }
}