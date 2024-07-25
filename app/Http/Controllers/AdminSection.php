<?php

namespace App\Http\Controllers;
use App\Models\Section;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Storage;

class AdminSection extends Controller
{
    public function index()
    {
        $data = Section::all();
        return view('dashboard.section.index', compact('data') );
    }

    public function create()
    {
        return view('dashboard.section.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:sections,name,',
            'image'=>'required|nullable|mimes:png,jpg,jpeg,webp',
            'description' => 'required'
        ], [
            'name.unique' => 'The section already exists'
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

        Section::create([
            'name' => $request->name,
            'description' => $request->description,
            'image'=> $path.$filename
        ]);
        session()->flash('success', 'Success create section.');

        return redirect()->route('section.index');
    }

    public function edit($id){
        $data = Section::find($id);
        return view('dashboard.section.update', compact('data'));
    }

    public function update(Request $request, $id){
        $section = Section::find($id);
        $request->validate([
            'name' => 'required|unique:sections,name,'.$id,
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'description' => 'required'
        ],
        [
            'name.unique' => 'The section already exists'
        ]
    );
    $path="";
    $path.$filename=$section->image;
    if($request->has('image')){
        $file = $request->file('image');
        $extension =$file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path = 'uplod/images/';
        $file->move($path,$filename);
    }
        $section->name = $request->name;
        $section->description = $request->description;
        $section->image= $path.$filename;
        $section->save();
        session()->flash('success_update', 'Success update section.');
        return redirect()->route('section.index');
    }

    public function destroy($id){
        $section = Section::find($id);
        $section->delete();
        session()->flash('success_delete', 'Success Delete section.');  
        return redirect()->route('section.index');
    }

    public function show(){
        $section = Section::onlyTrashed()->get();
        return view('dashboard.section.SoftDelete',compact('section'));
    }

    public function Restore($id){
        section::withTrashed()->where('id',$id)->restore();
        session()->flash('success_restore', 'Success restore.');  
        return redirect()->back();
    }

    public function ForceDelete($id){
        section::withTrashed()->where('id',$id)->forceDelete();
        session()->flash('success_delete', 'Success delete.');  
        return redirect()->back();
    }
}
