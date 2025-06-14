<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Supplier;

class AuthLogin extends Controller
{
    public function ViewClient() {
        return view('AuthClientSuppler.LoginClient');
    }

    public function ViewSupplier() {
        return view('AuthClientSuppler.LoginSuppler');
    }

    public function LoginClient(Request $request) {
        $credentials = $request->only('email', 'password');
        $client = Client::where('email', $request->email)->first();
        if ($client) {
            if (Auth::guard('Client')->attempt($credentials)) {
                $user = Auth::guard('Client')->user();
                session(['Client_user_id' => $user->id]);
                session()->flash('Success_Login_Client', 'Success Login'); 
                return redirect()->route('ServiceHouse.Home.Client');
            } else {
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ])->withInput();
            }
        } else {
            return back()->withErrors([
                'email' => 'The provided email does not valid.',
            ])->withInput();
        }
    }
    
    public function LoginSupplier(Request $request) {
        $credentials = $request->only('email', 'password');
        $supplier = Supplier::where('email', $request->email)->first();
        if ($supplier) {
            if (Auth::guard('Supplier')->attempt($credentials)) {
                $user = Auth::guard('Supplier')->user();
                session(['supplier_user_id' => $user->id]);
                session()->flash('Success_Login_Supplier', 'Success Login'); 
                return redirect()->route('ServiceHouse.Home.Supplier');
            } else {
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ])->withInput();
            }
        } else {
            return back()->withErrors([
                'email' => 'The provided email does not valid.',
            ])->withInput();
        }
    }

    public function LogoutSupplier()
    {
        session()->forget('suggested_services');
        Auth::guard('Supplier')->logout();
        return redirect()->route('AuthLoginn')->with('success', 'Logged out successfully.');
    }

    public function LogoutClient()
    {
        Auth::guard('Client')->logout();
        return redirect()->route('AuthLogin')->with('success', 'Logged out successfully.');
    }
}
