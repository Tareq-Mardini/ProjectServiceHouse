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
use App\Models\WorkExtra;
use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
//============================================================================================================

class SupplierController extends Controller
{
    public function View()
    {
        return view('Supplier.Home.Home');
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

        $validatedData = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('suppliers', 'name')->ignore($supplier->id),
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
            ],
            [
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

                'date_of_birth.required' => 'The date of birth is required.',
                'date_of_birth.date' => 'Please provide a valid date of birth.',
                'date_of_birth.before_or_equal' => 'You must be at least 18 years old and the date cannot be in the future.',
                'date_of_birth.after_or_equal' => 'The age must not exceed 100 years.',

                'image.image' => 'The uploaded file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
                'image.max' => 'The image size must not exceed 2048 kilobytes.',
            ]
        );

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
        $TestOrder = Order::where('supplier_id', $userId)
            ->where(function ($query) {
                $query->whereNotIn('supplier_status', ['rejection', 'completed'])
                    ->orWhere('order_status', '!=', 'approved');
            })
            ->first();
        if ($TestOrder) {
            session()->flash('fail_order', 'There are orders that have not been processed yet');
            return redirect()->back();
        }
        $balance = Wallet::where('user_id', $userId)
            ->where('role', 'supplier')
            ->value('balance');
        if ($balance) {
            session()->flash('fail_wallet', 'There is still a remaining balance in the wallet.');
            return redirect()->back();
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
        $offers = WorkExtra::where('work_id', $id)->get();
        return view('Supplier.Home.WorkInfo', compact('works', 'image', 'offers'));
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
        return view('Supplier.Home.portfolio', compact('portfolio', 'data', 'works'));
    }
    //============================================================================================================
}
