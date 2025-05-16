<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\services;
use App\Models\Service;
use App\Models\Work;

class AdminServiceController extends Controller
{
    public function index() {
        $data = services::all();
        return view('dashboard.service.index',compact('data'));
    }

    public function create() {
        $data = Section::all();
        return view('dashboard.service.create', compact('data') );
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:services,name,',
            'image'=>'required|nullable|mimes:png,jpg,jpeg,webp',
            'section_id'=>'required',
            'description' => 'required'
        ], [
            'name.unique' => 'The service already exists'
        ]);
        $path ="";
        $filename="";
        $file="";

        if($request->has('image')){
            $file = $request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'uplod/images/';
            $file->move($path,$filename);
        }

        services::create([
            'name' => $request->name,
            'description' => $request->description,
            'image'=> $path.$filename,
            'section_id'=>$request->section_id
        ]);
        session()->flash('success_create_service', 'Success create service.');

        return redirect()->route('admin.view.service');
    }

    public function edit($id)
    {
        $data = services::find($id);
        $data_section = Section::all();
        return view('dashboard.service.update', compact('data','data_section'));
    }

    public function update(Request $request, $id)
    {
        $services = services::find($id);
        $request->validate([
            'name' => 'required|unique:services,name,'.$id,
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'section_id'=>'required',
            'description' => 'required'
        ],
        [
            'name.unique' => 'The service already exists'
        ]
    );
    $path="";
    $path.$filename=$services->image;
    if($request->has('image')){
        $file = $request->file('image');
        $extension =$file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path = 'uplod/images/';
        $file->move($path,$filename);
    }
        $services->name = $request->name;
        $services->section_id=$request->section_id;
        $services->description = $request->description;
        $services->image= $path.$filename;
        $services->save();
        session()->flash('success_update_service', 'Success update service.');
        return redirect()->route('admin.view.service');
    }   

    public function delete($id)
    {
    $services = services::find($id);
    $TestWork = Work::where('service_id',$services->id)
    ->first();
    if($TestWork){
        session()->flash('fail_delete_service', 'The service cannot be deleted because there are works assigned to the supplier.');  
        return redirect()->back();
    }
        $services->delete();
        session()->flash('success_delete_service', 'Success Delete service.');  
        return redirect()->route('admin.view.service');
    }

    public function show(){
        $services = services::onlyTrashed()->get();
        return view('dashboard.service.SoftDelete',compact('services'));
    }

    public function Restore($id) {
        $services = services::withTrashed()->find($id);
        $data_section = Section::all();
        $sectionExists = $data_section->contains('id', $services->section_id);
        if ($sectionExists) {
            $services->restore();
            session()->flash('success_restore_service', 'Success restore service.');
            return redirect()->back();
        } else {
            session()->flash('fail_restore_service', 'Fail Restore Service because the Section in Archive.');
            return redirect()->back();
        }
    }
    
    public function ForceDelete($id){
        services::withTrashed()->where('id',$id)->forceDelete();
        session()->flash('success_delete_service', 'Success Delete service.'); 
        return redirect()->back();
    }
}
