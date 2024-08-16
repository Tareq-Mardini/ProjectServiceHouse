<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{
  public function ViewRegister() {
    return view('Client.AuthClient.Register');
  }

  public function Store(Request $request) {
    $validatedData = $request->validate([
      'email' => 'required|email|unique:clients,email',
      'password' => 'required|min:8|confirmed',
      'name' => 'required|string|max:255',
      'phone_number' => 'required|string|max:20',
      'address' => 'required|string|in:Algeria,Bahrain,Comoros,Djibouti,Egypt,Iraq,Jordan,Kuwait,Lebanon,Libya,Mauritania,Morocco,Oman,Palestine,Qatar,Saudi Arabia,Somalia,South Sudan,Sudan,Syria,Tunisia,United Arab Emirates,Yemen',
      'gender' => 'required|in:male,female',
      'date_of_birth' => 'required|date',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    $validatedData['password'] = Hash::make($validatedData['password']);
      $client = Client::create($validatedData);
      return back();
  }
}