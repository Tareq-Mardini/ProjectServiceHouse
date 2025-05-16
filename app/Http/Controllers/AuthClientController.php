<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{
  public function ViewRegister()
  {
    return view('Client.AuthClient.Register');
  }
  public function Store(Request $request)
  {
    // التحقق من البيانات المدخلة
    $validatedData = $request->validate([
      'email' => 'required|email|unique:clients,email',
      'password' => 'required|min:8|confirmed',
      'name' => 'required|string|unique:clients,name|max:255',
      'phone_number' => 'required|string|max:20',
      'address' => 'required|string|in:Algeria,Bahrain,Comoros,Djibouti,Egypt,Iraq,Jordan,Kuwait,Lebanon,Libya,Mauritania,Morocco,Oman,Palestine,Qatar,Saudi Arabia,Somalia,South Sudan,Sudan,Syria,Tunisia,United Arab Emirates,Yemen',
      'gender' => 'required|in:male,female',
      'date_of_birth' => [
        'required',
        'date',
        'before_or_equal:' . now()->subYears(18)->toDateString(),
        'after_or_equal:' . now()->subYears(100)->toDateString(),
      ],
      'confirm_info' => 'accepted',
    ], [
      'email.required' => 'The email address is required.',
      'email.email' => 'Please provide a valid email address.',
      'email.unique' => 'This email address is already in use.',
      'password.required' => 'A password is required.',
      'password.min' => 'The password must be at least 8 characters long.',
      'password.confirmed' => 'The password confirmation does not match.',
      'name.required' => 'The name is required.',
      'name.string' => 'The name must be a string.',
      'name.unique' => 'This name is already in use.',
      'name.max' => 'The name cannot exceed 255 characters.',
      'phone_number.required' => 'The phone number is required.',
      'phone_number.string' => 'The phone number must be a string.',
      'phone_number.max' => 'The phone number cannot exceed 20 characters.',
      'address.required' => 'The address is required.',
      'address.in' => 'The address must be one of the following: Algeria, Bahrain, Comoros, Djibouti, Egypt, Iraq, Jordan, Kuwait, Lebanon, Libya, Mauritania, Morocco, Oman, Palestine, Qatar, Saudi Arabia, Somalia, South Sudan, Sudan, Syria, Tunisia, United Arab Emirates, Yemen.',
      'gender.required' => 'The gender is required.',
      'gender.in' => 'The gender must be either male or female.',
      'date_of_birth.required' => 'The date of birth is required.',
      'date_of_birth.date' => 'Please provide a valid date of birth.',
      'date_of_birth.before_or_equal' => 'You must be at least 18 years old and the date cannot be in the future.',
      'date_of_birth.after_or_equal' => 'The age must not exceed 100 years.',
    ]);
    $validatedData['password'] = Hash::make($validatedData['password']);
    $imagePath = 'images/works/multiple/istockphoto-2041572395-612x612.jpg';
    $validatedData['image'] = $imagePath;
    $client = Client::create($validatedData);
    return redirect()->route('AuthLogin');
  }
}
