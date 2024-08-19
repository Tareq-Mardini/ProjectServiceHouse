<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Supplier;

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
            $email = $request->email;
            if (Auth::guard('Client')->attempt($credentials)) {
                
                    $client = Client::where('email', $email)->first(['name']);
                
                session()->flash('success_login', 'Success login cc.'); 
                return $client;
            } else {
                return $ff;
            }
        }    
    }
    
    public function LoginSupplier(Request $request) {
        {
            $tt ="hlaa";
            $ff ="false";
            $credentials = $request->only('email', 'password');
            $email = $request->email;
            if (Auth::guard('Supplier')->attempt($credentials)) {
                
                    $supplier = Supplier::where('email', $email)->first(['name']);
                
                session()->flash('success_login', 'Success login cc.'); 
                return $supplier;
            } else {
                return $ff;
            }
        }    
    }
}
