<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLogin extends Controller
{
    public function View() {
        return view('AuthClientSuppler.LoginClientSuppler');
    }

    public function LoginClient(Request $request) {
        {
            $tt ="hlaa";
            $ff ="false";
            $credentials = $request->only('email', 'password');
            if (Auth::guard('Client')->attempt($credentials)) {
                session()->flash('success_login', 'Success login cc.'); 
                return $tt;
            } else {
                return $ff;
            }
        }    
    }
}
