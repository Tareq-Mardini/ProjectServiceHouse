<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminLogin extends Controller
{
    public function login()
    {
        return view('Admin/AdminLogin');
    }

    public function checkLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            session()->flash('success_login', 'Success login admin.'); 
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->withErrors(['loginError' => 'Invalid credentials, try again']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}

