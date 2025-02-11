<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\services;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Work;
use App\Models\WorkImage;
use App\Models\Portfolio;
//============================================================================================================

class SupplierController extends Controller
{
    public function View()
    {
        return view('Supplier.Home.Home');
    }
    //============================================================================================================

    public function ViewDashboard()
    {
        return view('Supplier.Home.Dashboard');
    }
    //============================================================================================================

    public function ShowSections()
    {
        $data = Section::all();
        return view('Supplier.Home.Sections', compact('data'));
    }
    //============================================================================================================

    public function ShowServices($id)
    {
        $data = services::where('section_id', $id)->get();
        return view('Supplier.Home.Services', compact('data'));
    }
    //============================================================================================================

    public function ViewAccount()
    {
        $userId = session('supplier_user_id');
        $supplier = Supplier::find($userId);
        return view('Supplier.Home.Account.MyAccount', compact('supplier'));
    }
    //============================================================================================================

    public function UpdateAccount()
    {
        $userId = session('supplier_user_id');
        $supplier = Supplier::find($userId);
        return view('Supplier.Home.Account.UpdateAccount', compact('supplier'));
    }
    //============================================================================================================

    public function EditAccount(Request $request)
    {
        $userId = session('supplier_user_id');
        $supplier = Supplier::find($userId);

        if (!$supplier) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('suppliers', 'name')->ignore($supplier->id),
            ],
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|in:Algeria,Bahrain,Comoros,Djibouti,Egypt,Iraq,Jordan,Kuwait,Lebanon,Libya,Mauritania,Morocco,Oman,Palestine,Qatar,Saudi Arabia,Somalia,South Sudan,Sudan,Syria,Tunisia,United Arab Emirates,Yemen',
            'date_of_birth' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'new_password' => 'nullable|min:8|confirmed',
            'current_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $supplier->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $supplier->name = $request->name;
        $supplier->phone_number = $request->phone_number;
        $supplier->address = $request->address;
        $supplier->date_of_birth = $request->date_of_birth;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/suppliers', 'public');
            $supplier->image = $imagePath;
        }
        if ($request->new_password) {
            $supplier->password = Hash::make($request->new_password);
        }
        $supplier->save();
        session()->flash('Success_Update', 'Success Update Account'); 
        return redirect()->route('Supplier.View.Account')->with('success', 'Account updated successfully.');
    }
    //============================================================================================================

    public function DeleteAccount(Request $request)
    {
        $userId = session('supplier_user_id');
        $supplier = Supplier::find($userId);
        $request->validate([
            'current_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $supplier->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $supplier->delete();
        $request->session()->flush();
        return redirect('ServiceHouse')->with('success', 'Your account has been deleted successfully.');
    }
    //============================================================================================================
    public function ViewWorks($id)
    {
        $data = Work::where('service_id', $id)->get();
        return view('Supplier.Home.Works', compact('data'));
    }
    //============================================================================================================

    public function ViewinfoWorks($id)
    {
        $works = Work::where('id', $id)->first();
        $image = WorkImage::where('work_id', $id)->get('image_path');
        return view('Supplier.Home.WorkInfo', compact('works', 'image'));
    }
    //============================================================================================================
    public function ViewPortfolio($id)
    {
        $works = Work::where('supplier_id', $id)->get();
        $data = Supplier::select('name', 'image')->where('id', $id)->first();
        $portfolio = Portfolio::with(['skills', 'educations', 'experiences', 'galleries'])
            ->where('supplier_id', $id)
            ->first();
        if (!$portfolio) {
            return view('Supplier.Home.NullPortfolio');
        }
        return view('Supplier.Home.portfolio', compact('portfolio','data','works'));
    }
    //============================================================================================================
}
