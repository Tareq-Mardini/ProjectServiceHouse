<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\services;
use App\Models\Work;
use App\Models\WorkImage;
use App\Models\Supplier;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        return view('Client.Home.Sections', compact('data'));
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
        return view('Client.Home.Works', compact('data'));
    }
    //==========================================================================
    public function ViewinfoWorks($id)
    {
        $works = Work::where('id', $id)->first();
        $image = WorkImage::where('work_id', $id)->get('image_path');
        return view('Client.Home.WorkInfo', compact('works', 'image'));
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
    public function ViewSettings(){
        return view('Client.Settings.ViewSettings');
    }
    //============================
    public function ViewAccount()
    {
        $userId = session('Client_user_id');
        $Client = Client::find($userId);
        return view('Client.Settings.Account.ViewAccount', compact('Client'));
    }
    //=============================================
    public function UpdateAccount()
    {
        $userId = session('Client_user_id');
        $Client = Client::find($userId);
        return view('Client.Settings.Account.UpdateAccount', compact('Client'));
    }
    //==================================================
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
            'date_of_birth' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'new_password' => 'nullable|min:8|confirmed',
            'current_password' => 'required',
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

}
