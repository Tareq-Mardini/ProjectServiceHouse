<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;

class WalletController extends Controller
{
    //عرض واجهة الكريت للمحفظة
    public function CreateWallet()
    {
        return view('Client.Settings.Wallet.Create');
    }
    //=======================================================================================================================
    //تخزين المعلومات للمحفظة لو عامل محفظة من قبل بخليه يرجع للصفحة لو مو عامل بخليه يكمل 
    // ملاحظة صغيرة كمان ^_^ مشان هاد التابع هو مالح يعرض بالأصل الكريت بس في طريقة حفظ الراوت ووضعه بالبحث 
    // مشان هيك نحنا منضمن حتى لو عمل هي الطريقة مالح يخليه بالأصل يعمل بطاقة جديدة وهو عندو بطاقة بالأصل
    public function StoreWallet(Request $request)
    {
        $request->validate([
            'wallet_password' => [
                'required',
                'string',
                'min:10',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            ],
        ], [
            'wallet_password.required' => 'Wallet password is required.',
            'wallet_password.string' => 'Wallet password must be a string.',
            'wallet_password.min' => 'Wallet password must be at least 10 characters.',
            'wallet_password.confirmed' => 'Wallet password confirmation does not match.',
            'wallet_password.regex' => 'Wallet password must contain both letters and numbers.',
        ]);
        $userId = session('Client_user_id');
        $existingWallet = Wallet::where('user_id', $userId)
            ->where('role', 'client')
            ->first();

        if ($existingWallet) {
            session()->flash('ErrorCreateWallet', 'You already have your card');
            return redirect()->route('View.wallet.clinet');
        } else {
            $wallet = Wallet::create([
                'user_id' => $userId,
                'role' => 'client',
                'wallet_password' => Hash::make($request->wallet_password),
                'balance' => 0,
            ]);
            session()->flash('SuccessCreateWallet', 'Success Create Wallet');
            return redirect()->route('View.wallet.clinet');
        }
    }
    //=======================================================================================================================
    //عرض المحفظة مع خيار لو كان الزبون عامل محفظة بيعرض المحفظة لو مو عامل محفظة بيعرض الواجعة الفاضية يلي فيها كريت للمحفظة
    public function ViewWallet()
    {
        $userId = session('Client_user_id');
        $existingWallet = Wallet::where('user_id', $userId)
            ->where('role', 'client')
            ->first();
        if ($existingWallet) {
            return view('Client.Settings.Wallet.ViewWallet', compact('existingWallet'));
        } else {
            return view('Client.Settings.Wallet.ViewWalletNull');
        }
    }
    //=======================================================================================================================
    // تابع مشان عرض الرصيد المحفظة لكلاينت معين
    public function Balance($wallet_id)
    {
        $userId = session('Client_user_id');
        $wallet = Wallet::where('id', $wallet_id)
            ->where('user_id', $userId) // تأكد إنه تبع المستخدم الحالي
            ->firstOrFail();
        session()->flash('Balance', "The Balance is {$wallet->balance} $");
        return redirect()->route('View.wallet.clinet');
    }
    //=======================================================================================================================

    public function update()
    {
        $userId = session('Client_user_id');
        $existingWallet = Wallet::where('user_id', $userId)
            ->where('role', 'client')
            ->first();
        if ($existingWallet) {
            return view('Client.Settings.Wallet.Update', compact('existingWallet'));
        }
    }
    //=======================================================================================================================

    public function UpdateWalletPassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'wallet_password' => [
                'required',
                'string',
                'min:10',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            ],
        ], [
            'old_password.required' => 'Current password is required.',
            'wallet_password.required' => 'New password is required.',
            'wallet_password.string' => 'New password must be a string.',
            'wallet_password.min' => 'New password must be at least 10 characters.',
            'wallet_password.confirmed' => 'Password confirmation does not match.',
            'wallet_password.regex' => 'New password must contain both letters and numbers.',
        ]);

        $userId = session('Client_user_id');
        $wallet = Wallet::where('user_id', $userId)->where('role', 'client')->first();

        if (!$wallet) {
            return redirect()->route('View.wallet.clinet');
        }

        if (!Hash::check($request->old_password, $wallet->wallet_password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $wallet->update([
            'wallet_password' => Hash::make($request->wallet_password),
        ]);
        session()->flash('SuccessUpdateWallet', 'Success Update Wallet');
        return redirect()->route('View.wallet.clinet');
    }
    //=======================================================================================================================

    public function CreateWalletSupplier()
    {
        return view('Supplier.Home.Wallet.Create');
    }
    //=======================================================================================================================

    public function StoreWalletSupplier(Request $request)
    {
        $request->validate([
            'wallet_password' => [
                'required',
                'string',
                'min:10',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            ],
        ], [
            'wallet_password.required' => 'Wallet password is required.',
            'wallet_password.string' => 'Wallet password must be a string.',
            'wallet_password.min' => 'Wallet password must be at least 10 characters.',
            'wallet_password.confirmed' => 'Wallet password confirmation does not match.',
            'wallet_password.regex' => 'Wallet password must contain both letters and numbers.',
        ]);
        $userId = session('supplier_user_id');
        $existingWallet = Wallet::where('user_id', $userId)
            ->where('role', 'supplier')
            ->first();

        if ($existingWallet) {
            session()->flash('ErrorCreateWallet', 'You already have your card');
            return redirect()->route('View.wallet.supplier');
        } else {
            $wallet = Wallet::create([
                'user_id' => $userId,
                'role' => 'supplier',
                'wallet_password' => Hash::make($request->wallet_password),
                'balance' => 0,
            ]);
            session()->flash('SuccessCreateWallet', 'Success Create Wallet');
            return redirect()->route('View.wallet.supplier');
        }
    }
    //=======================================================================================================================


    public function ViewWalletSupplier()
    {
        $userId = session('supplier_user_id');
        $existingWallet = Wallet::where('user_id', $userId)
            ->where('role', 'supplier')
            ->first();
        if ($existingWallet) {
            return view('Supplier.Home.Wallet.ViewWallet', compact('existingWallet'));
        } else {
            return view('Supplier.Home.Wallet.ViewWalletNull');
        }
    }

    //=======================================================================================================================

    public function BalanceSupplier($wallet_id)
    {
        $userId = session('supplier_user_id');
        $wallet = Wallet::where('id', $wallet_id)
            ->where('user_id', $userId) // تأكد إنه تبع المستخدم الحالي
            ->firstOrFail();
        session()->flash('Balance', "The Balance is {$wallet->balance} $");
        return redirect()->route('View.wallet.supplier');
    }
    //=======================================================================================================================

    public function UpdateWalletSupplier()
    {
        $userId = session('supplier_user_id');
        $existingWallet = Wallet::where('user_id', $userId)
            ->where('role', 'supplier')
            ->first();
        if ($existingWallet) {
            return view('Supplier.Home.Wallet.Update', compact('existingWallet'));
        }
    }
    //=======================================================================================================================

    public function UpdateWalletPasswordSupplier(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'wallet_password' => [
                'required',
                'string',
                'min:10',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            ],
        ], [
            'old_password.required' => 'Current password is required.',
            'wallet_password.required' => 'New password is required.',
            'wallet_password.string' => 'New password must be a string.',
            'wallet_password.min' => 'New password must be at least 10 characters.',
            'wallet_password.confirmed' => 'Password confirmation does not match.',
            'wallet_password.regex' => 'New password must contain both letters and numbers.',
        ]);

        $userId = session('supplier_user_id');
        $wallet = Wallet::where('user_id', $userId)->where('role', 'supplier')->first();

        if (!$wallet) {
            return redirect()->route('View.wallet.supplier');
        }

        if (!Hash::check($request->old_password, $wallet->wallet_password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $wallet->update([
            'wallet_password' => Hash::make($request->wallet_password),
        ]);
        session()->flash('SuccessUpdateWallet', 'Success Update Wallet');
        return redirect()->route('View.wallet.supplier');
    }
}
