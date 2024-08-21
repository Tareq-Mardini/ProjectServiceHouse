<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthSupplierController extends Controller
{
    public function ViewRegister() {
        return view('Supplier.AuthSupplier.Register');
    }

    public function Store(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:suppliers,email',
            'password' => 'required|min:8|confirmed',
            'name' => 'required|string|unique:suppliers,name|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|in:Algeria,Bahrain,Comoros,Djibouti,Egypt,Iraq,Jordan,Kuwait,Lebanon,Libya,Mauritania,Morocco,Oman,Palestine,Qatar,Saudi Arabia,Somalia,South Sudan,Sudan,Syria,Tunisia,United Arab Emirates,Yemen',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'confirm_info' => 'accepted',
            'status' => 'required|in:student,employed', 
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
            
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image size must not exceed 2048 kilobytes.',
            
            'confirm_info.accepted' => 'You must accept the information.',
            
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be either student or employed.',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $supplier = Supplier::create($validatedData);
        return redirect()->route('AuthLoginn');
    }
}
