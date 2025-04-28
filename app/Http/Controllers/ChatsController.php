<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\SendClientMessage;
use App\Models\Client;
use App\Models\Supplier;
use App\Events\SendSupplierMessage;

class ChatsController extends Controller

{ //======================================================================================================================================
    // هاد الكود مشان بس اكبس على سابلير معين من بعد ما شوف تفاصيل العمل بس اكبس على المحادثة بيطلعي الواجهة مع الرسائل يلي باعتها 
    public function ViewChat(Request $request)
    {
        $clientId = session('Client_user_id');
        $supplierId = $request->id;
        $supplier = Supplier::findOrFail($supplierId);
        $messages = Chat::where(function ($query) use ($supplierId, $clientId) {
            $query->where('sender_id', $clientId)
                ->where('receiver_id', $supplierId)
                ->where('role', 'client');
        })
            ->orWhere(function ($query) use ($supplierId, $clientId) {
                $query->where('sender_id', $supplierId)
                    ->where('receiver_id', $clientId)
                    ->where('role', 'supplier');
            })
            ->orderBy('created_at', 'asc')
            ->get();
        return view('Client.Home.Chat', compact('supplier', 'messages'));
    }
    //======================================================================================================================================
    //تابع لتحزين الرسالة يلي بتنبعت من الزبون للسبلاير مع استدعاء الايفينت مشان توصل الرسالة للسبلاير المطلوب بالوقت الفعلي
    public function SendMessageFromClientToSupplier(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|required_without:image',
            'id' => 'required|integer',
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

        $chat = Chat::create([
            'sender_id' => session('Client_user_id'),
            'receiver_id' => $request->id,
            'message' => $request->input('message'),
            'role' => 'client',
            'seen' => false,
            'image' => $imagePath
        ]);

        event(new SendClientMessage($chat));
        return response()->json([
            'success' => true,
            'message' => 'تم إرسال الرسالة بنجاح',
            'image_url' => $imagePath ? asset('storage/' . $imagePath) : null
        ]);
    }
    //===========================================================================================================================================
    //هاد الفانكشن مشان يعرض جميع الزبائن يلي بعتو للسبلاير رسالة 
    public function ViewChats()
    {
        $supplierId = session('supplier_user_id');
        $clientIds = Chat::where('receiver_id', $supplierId)
            ->where('role', 'client')
            ->pluck('sender_id')
            ->unique();
        $clients = Client::whereIn('id', $clientIds)->get();
        return view('Supplier.Home.Chat.view', compact('clients'));
    }
    //===========================================================================================================================================
    //هاد الفانكشن مشان بس اكبس على محادثة زبون معين يعرض الرسائل المحادثة
    public function ViewChatClient($clientId)
    {
        $supplierId = session('supplier_user_id');
        $client = Client::findOrFail($clientId);

        $messages = Chat::where(function ($query) use ($supplierId, $clientId) {
            $query->where('sender_id', $supplierId)
                ->where('receiver_id', $clientId)
                ->where('role', 'supplier');
        })
            ->orWhere(function ($query) use ($supplierId, $clientId) {
                $query->where('sender_id', $clientId)
                    ->where('receiver_id', $supplierId)
                    ->where('role', '!=', 'supplier');
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('Supplier.Home.Chat.ViewChatClient', compact('client', 'messages'));
    }
    //===========================================================================================================================================
    // هاد التابع بخزن الرسالة يلي بعتها السبلاير للزبون بجدول التشات وكمان بيستدعي الايفينت مشان ترسل البيانات للطرف الثاني يلي عامل اشتراك 
    public function SendMessageFromSupplierToClient(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|required_without:image',
            'id' => 'required|integer',
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

        $chat = Chat::create([
            'sender_id' => session('supplier_user_id'),
            'receiver_id' => $request->id,
            'message' => $request->input('message'),
            'role' => 'supplier',
            'seen' => false,
            'image' => $imagePath
        ]);

        event(new SendSupplierMessage($chat));
        return response()->json([
            'success' => true,
            'message' => $chat->message,
            'image_url' => $imagePath ? asset('storage/' . $imagePath) : null
        ]);
    }
    //===========================================================================================================================================
    //هاد الفانكشن مشان يعرضلي كلشي اسماء سابلير تواصلت معاهم ^_^
    public function ViewChatsForClient()
    {
        $ClientId = session('Client_user_id');
        $SupplierId = Chat::where('receiver_id', $ClientId)
            ->where('role', 'supplier')
            ->pluck('sender_id')
            ->unique();
        $suppliers = supplier::whereIn('id', $SupplierId)->get();
        return view('Client.Settings.Chat.ViewChat', compact('suppliers'));
    }
    //===========================================================================================================================================
    // هاد الكود مشان بس اكبس على شي سابلير معين من ضمن الليستة يلي عنا يعرضلي رسائلو كاملة 
    public function ViewChatSupplier(Request $request)
    {
        $clientId = session('Client_user_id');
        $supplierId = $request->id;
        $supplier = Supplier::findOrFail($supplierId);
        $messages = Chat::where(function ($query) use ($supplierId, $clientId) {
            $query->where('sender_id', $clientId)
                ->where('receiver_id', $supplierId)
                ->where('role', 'client');
        })
            ->orWhere(function ($query) use ($supplierId, $clientId) {
                $query->where('sender_id', $supplierId)
                    ->where('receiver_id', $clientId)
                    ->where('role', 'supplier');
            })
            ->orderBy('created_at', 'asc')
            ->get();
        return view('Client.Settings.Chat.ViewChatSupplier', compact('supplier', 'messages'));
    }
    //===========================================================================================================================================

}
