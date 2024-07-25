<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('admin/dashboard');
    }

    public function ViewAccount() {
        $data = Admin::first();
        return view('dashboardd/setting', compact('data'));
    }
    
    public function EditAccount(Request $request) {
        $Admin =  Admin::first(); 
        if ($Admin && Hash::check($request->current, $Admin->password)) {
        $Admin->name = $request->name;
        $Admin->email = $request->email;
        if($request->password !=null){
        $Admin->password = bcrypt($request->password) ;}
        $Admin->ph_number = $request->ph_number;
        $Admin->save();
        session()->flash('success_update_account', 'Success update account.');  
        return redirect()->route('admin.setting');
        }
        else {
            session()->flash('failed', 'failed edit account.');
            return redirect()->route('admin.setting');
        }
    }
}