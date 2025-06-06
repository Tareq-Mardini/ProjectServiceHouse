<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientService;
use App\Models\ClientServiceViews;
use App\Models\Favorite;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\services;
use App\Models\Work;
use App\Models\WorkImage;
use App\Models\Supplier;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\WorkExtra;
use App\Models\Review;
use App\Models\Wallet;

class ClientController extends Controller
{
    public function View()
    {
        return view('Client.Home.Home');
    }
    //==========================================================================
    public function ShowSections()
    {
        $data = Section::all();
        $clientId = session('Client_user_id');
        return view('Client.Home.Sections', compact('data','clientId'));
    }
    //==========================================================================
    public function ShowServices($id)
    {
        $data = services::where('section_id', $id)->get();
        return view('Client.Home.Services', compact('data'));
    }
    //==========================================================================
    public function ViewWorks($id)
    {
        $data = Work::where('service_id', $id)->get();
        $userId = session('Client_user_id');
        $favorites = [];
        if ($userId) {
            $favorites = Favorite::where('client_id', $userId)
                ->pluck('work_id')
                ->toArray();
        }

        $userId = session('Client_user_id');
        ClientServiceViews::firstOrCreate([
                'client_id' => $userId,
                'service_id' => $id,
        ]);
        
        return view('Client.Home.Works', compact('data', 'favorites'));
    }
    //==========================================================================
    public function ViewinfoWorks($id)
    {
        $works = Work::where('id', $id)->first();
        $image = WorkImage::where('work_id', $id)->get('image_path');
        $offers = WorkExtra::where('work_id', $id)->get();
        $reviews = Review::with('client') // العلاقة مع الزبون
            ->where('work_id', $works->id)
            ->latest()
            ->get();

        return view('Client.Home.WorkInfo', compact('works', 'image', 'offers', 'reviews'));
    }
    //==========================================================================
    public function ViewPortfolio($id)
    {
        $works = Work::where('supplier_id', $id)->get();
        $data = Supplier::select('name', 'image')->where('id', $id)->first();
        $portfolio = Portfolio::with(['skills', 'educations', 'experiences', 'galleries'])
            ->where('supplier_id', $id)
            ->first();
        if (!$portfolio) {
            return view('Client.Home.NullPortfolio');
        }
        return view('Client.Home.portfolio', compact('portfolio', 'data', 'works'));
    }
    //==========================================================================
    public function ViewSettings()
    {
        return view('Client.Settings.ViewSettings');
    }
    //==========================================================================
    public function ViewAccount()
    {
        $userId = session('Client_user_id');
        $Client = Client::find($userId);
        return view('Client.Settings.Account.ViewAccount', compact('Client'));
    }
    //==========================================================================
    public function UpdateAccount()
    {
        $userId = session('Client_user_id');
        $Client = Client::find($userId);
        return view('Client.Settings.Account.UpdateAccount', compact('Client'));
    }
    //==========================================================================
    public function EditAccount(Request $request)
    {
        $userId = session('Client_user_id');
        $Client = Client::find($userId);

        if (!$Client) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('clients', 'name')->ignore($Client->id),
            ],
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|in:Algeria,Bahrain,Comoros,Djibouti,Egypt,Iraq,Jordan,Kuwait,Lebanon,Libya,Mauritania,Morocco,Oman,Palestine,Qatar,Saudi Arabia,Somalia,South Sudan,Sudan,Syria,Tunisia,United Arab Emirates,Yemen',
            'date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->toDateString(),
                'after_or_equal:' . now()->subYears(100)->toDateString(),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'new_password' => 'nullable|min:8|confirmed',
            'current_password' => 'required',
        ], [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'This name is already taken. Please choose another.',

            'phone_number.required' => 'The phone number is required.',
            'phone_number.string' => 'The phone number must be a string.',
            'phone_number.max' => 'The phone number may not be greater than 20 characters.',

            'address.required' => 'The address is required.',
            'address.string' => 'The address must be a string.',
            'address.in' => 'The address must be one of the specified Arab countries.',

            'date_of_birth.required' => 'The date of birth is required.',
            'date_of_birth.date' => 'Please enter a valid date of birth.',
            'date_of_birth.before_or_equal' => 'You must be at least 18 years old.',
            'date_of_birth.after_or_equal' => 'Age cannot exceed 100 years.',

            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image size must not exceed 2MB.',

            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password.confirmed' => 'The new password confirmation does not match.',

            'current_password.required' => 'The current password is required for verification.',
        ]);

        if (!Hash::check($request->current_password, $Client->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $Client->name = $request->name;
        $Client->phone_number = $request->phone_number;
        $Client->address = $request->address;
        $Client->date_of_birth = $request->date_of_birth;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/clients', 'public');
            $Client->image = $imagePath;
        }
        if ($request->new_password) {
            $Client->password = Hash::make($request->new_password);
        }
        $Client->save();
        session()->flash('Success_Update', 'Success Update Account');
        return redirect()->route('Client.View.Account')->with('success', 'Account updated successfully.');
    }
    //==========================================================================

    public function DeleteAccount(Request $request)
    {
        $userId = session('Client_user_id');
        $TestWallet = Wallet::where('user_id', $userId)
            ->where('role', 'client')->first();
        $TestOrder = Order::where('client_id', $userId)
            ->whereNot('order_status', 'approved')->first();
        if ($TestWallet->balance > 0) {
            session()->flash('wrong_delete_wallet', "You still have funds in your wallet, Please withdraw the remaining balance before deleting your account.");
            return redirect()->back();
        }
        if ($TestOrder) {
            session()->flash('wrong_delete_order', 'You cannot delete this account because there are still pending orders that have not been approved');
            return redirect()->back();
        } else {
            $client = Client::find($userId);
            $request->validate([
                'current_password' => 'required',
            ]);
            if (!Hash::check($request->current_password, $client->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            $client->delete();
            $request->session()->flush();
            return redirect('ServiceHouse')->with('success', 'Your account has been deleted successfully.');
        }
    }
}
