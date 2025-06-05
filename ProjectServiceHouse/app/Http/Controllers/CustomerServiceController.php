<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerService;
use App\Events\SendClientMessageToAdmin;
use App\Models\Client;
use App\Models\Supplier;
use App\Events\SendAdminMessageToClient;
use App\Events\SendSupplierMessageToAdmin;
use App\Events\SendAdminMessageToSupplier;

class CustomerServiceController extends Controller
{
    //==================================================================================================
    // عرض واجهة التواصل مع الدعم (واجهة الكلاينت)
    public function communication()
    {
        $ClientID = session('Client_user_id');
        $client = Client::findOrFail($ClientID);
        $messages = CustomerService::where(function ($query) use ($ClientID) {
            $query->where('sender_id', $ClientID)
                ->where('role', 'client')
                ->where('receiver_id', 0);
        })
            ->orWhere(function ($query) use ($ClientID) {
                $query->where('sender_id', 0)
                    ->where('role', 'client')
                    ->where('receiver_id', $ClientID);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        return view('Client.Settings.CustomerService.communication', compact('client', 'messages'));
    }
    //==================================================================================================
    // ارسال رسالة من الكلاينت للادمن 
    public function SendMessageFromClientToAdmin(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|required_without:image',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|required_without:message'
        ]);
        if (empty($request->message) && !$request->hasFile('image')) {
            return response()->json([
                'success' => false,
                'message' => 'يجب إدخال رسالة أو صورة على الأقل'
            ], 422);
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }
        $chat = CustomerService::create([
            'sender_id' => session('Client_user_id'),
            'receiver_id' => 0,
            'message' => $request->input('message'),
            'role' => 'client',
            'seen' => false,
            'image' => $imagePath
        ]);
        event(new SendClientMessageToAdmin($chat));
        return response()->json([
            'success' => true,
            'message' => $chat->message,
            'image_url' => $imagePath ? asset('storage/' . $imagePath) : null
        ]);
    }
    //==================================================================================================


    // عرض واجهة المتواصلين مع الادمن سواء كانو سابلير او كلاينت 
    public function ViewCustomerService()
    {
        $clientId = CustomerService::where('role', 'client')
            ->pluck('sender_id')
            ->unique();
        $supplierId = CustomerService::where('role', 'supplier')
            ->pluck('sender_id')
            ->unique();
        $clients = Client::whereIn('id', $clientId)->get();
        $suppliers = Supplier::whereIn('id', $supplierId)->get();
        return view('dashboard.CustomerService.View', compact('clients', 'suppliers'));
    }
    //==================================================================================================

    // عرض المحادثة يلي بعتها الزبون للادمن 
    public function ViewChatClient(Request $request)
    {
        $ClientID = $request->clientId;
        $client = Client::findOrFail($ClientID);
        $messages = CustomerService::where(function ($query) use ($ClientID) {
            $query->where('sender_id', $ClientID)
                ->where('role', 'client')
                ->where('receiver_id', 0);
        })
            ->orWhere(function ($query) use ($ClientID) {
                $query->where('sender_id', 0)
                    ->where('role', 'client')
                    ->where('receiver_id', $ClientID);
            })

            ->orderBy('created_at', 'asc')
            ->get();
        return  view('dashboard.CustomerService.ViewChatClient', compact('client', 'messages'));
    }
    //==================================================================================================

    // هاد مشان ابعت رسالة من الادمن للكلاينت وخزن الرسالة بالجدول ونبعتها عبر الايفينت
    public function SendMessageFromAdminToClient(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|required_without:image',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|required_without:message',
            'id' => 'required|integer'
        ]);
        if (empty($request->message) && !$request->hasFile('image')) {
            return response()->json([
                'success' => false,
                'message' => 'يجب إدخال رسالة أو صورة على الأقل'
            ], 422);
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }
        $chat = CustomerService::create([
            'sender_id' => 0,
            'receiver_id' => $request->id,
            'message' => $request->input('message'),
            'role' => 'client',
            'seen' => false,
            'image' => $imagePath
        ]);
        event(new SendAdminMessageToClient($chat));
        return response()->json([
            'success' => true,
            'message' => $chat->message,
            'image_url' => $imagePath ? asset('storage/' . $imagePath) : null
        ]);
    }
    //==================================================================================================

    // عرض واجهة التواصل مع الدعم (واجهة السابلاير)
    public function communicationSupplier()
    {
        $SupplierID = session('supplier_user_id');
        $supplier = Supplier::findOrFail($SupplierID);
        $messages = CustomerService::where(function ($query) use ($SupplierID) {
            $query->where('sender_id', $SupplierID)
                ->where('role', 'Supplier')
                ->where('receiver_id', 0);
        })
            ->orWhere(function ($query) use ($SupplierID) {
                $query->where('sender_id', 0)
                    ->where('role', 'Supplier')
                    ->where('receiver_id', $SupplierID);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        return view('Supplier.Home.CustomerService.communication', compact('supplier', 'messages'));
    }
    //==================================================================================================

    // ارسال رسالة من السابلاير للادمن 
    public function SendMessageFromSupplierToAdmin(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|required_without:image',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|required_without:message'
        ]);
        if (empty($request->message) && !$request->hasFile('image')) {
            return response()->json([
                'success' => false,
                'message' => 'يجب إدخال رسالة أو صورة على الأقل'
            ], 422);
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }
        $chat = CustomerService::create([
            'sender_id' => session('supplier_user_id'),
            'receiver_id' => 0,
            'message' => $request->input('message'),
            'role' => 'supplier',
            'seen' => false,
            'image' => $imagePath
        ]);
        event(new SendSupplierMessageToAdmin($chat));
        return response()->json([
            'success' => true,
            'message' => $chat->message,
            'image_url' => $imagePath ? asset('storage/' . $imagePath) : null
        ]);
    }
    //==================================================================================================

    // عرض المحادثة يلي بعتها السابلاير للادمن 
    public function ViewChatSupplier(Request $request)
    {
        $SupplierID = $request->supplierId;
        $supplier = Supplier::findOrFail($SupplierID);
        $messages = CustomerService::where(function ($query) use ($SupplierID) {
            $query->where('sender_id', $SupplierID)
                ->where('role', 'supplier')
                ->where('receiver_id', 0);
        })
            ->orWhere(function ($query) use ($SupplierID) {
                $query->where('sender_id', 0)
                    ->where('role', 'supplier')
                    ->where('receiver_id', $SupplierID);
            })

            ->orderBy('created_at', 'asc')
            ->get();
        return  view('dashboard.CustomerService.ViewChatSupplier', compact('supplier', 'messages'));
    }
    //==================================================================================================

    // هاد مشان ابعت رسالة من الادمن للسبلاير وخزن الرسالة بالجدول ونبعتها عبر الايفينت
    public function SendMessageFromAdminToSupplier(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|required_without:image',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|required_without:message',
            'id' => 'required|integer'
        ]);
        if (empty($request->message) && !$request->hasFile('image')) {
            return response()->json([
                'success' => false,
                'message' => 'يجب إدخال رسالة أو صورة على الأقل'
            ], 422);
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }
        $chat = CustomerService::create([
            'sender_id' => 0,
            'receiver_id' => $request->id,
            'message' => $request->input('message'),
            'role' => 'supplier',
            'seen' => false,
            'image' => $imagePath
        ]);
        event(new SendAdminMessageToSupplier($chat));
        return response()->json([
            'success' => true,
            'message' => $chat->message,
            'image_url' => $imagePath ? asset('storage/' . $imagePath) : null
        ]);
    }
    //==================================================================================================

}
