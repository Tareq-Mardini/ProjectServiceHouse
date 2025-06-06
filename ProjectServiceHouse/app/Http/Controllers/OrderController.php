<?php

namespace App\Http\Controllers;

use App\Events\WalletBalanceDecreasedClient;
use App\Events\WalletBalanceIncreasedSupplier;
use App\Events\WalletBalanceRefundedClient;
use App\Models\Work;
use App\Models\WorkExtra;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use App\Models\Order;
use App\Models\OrderFile;
use App\Models\Chat;

class OrderController extends Controller
{
  //=======================================================================================================================

  public function order($id)
  {
    $userId = session('Client_user_id');
    $HavingWallet = Wallet::where('user_id', $userId)
      ->where('role', 'client')->first();
    if ($HavingWallet) {
      $works = Work::where('id', $id)->first();
      $offers = WorkExtra::where('work_id', $id)->get();
      return view('Client.Home.Order', compact('works', 'offers'));
    } else {
      session()->flash('have_wallet', 'You dont have a wallet');
      return redirect()->back();
    }
  }
  //=======================================================================================================================

  public function CreateOrder(Request $request)
  {
    $request->validate(['order_description' => 'required'],);
    $order_description = $request->order_description;
    $selectedOffers = explode(',', $request->selected_offers);
    $id_work = $request->id_work;
    $id_supplier = $request->id_supplier;
    $order_price = $request->total_price;
    $userId = session('Client_user_id');
    $number = $request->wallet_number;
    $wallet = Wallet::where('wallet_number', $number)->first();
    if ($wallet) {
      if ($wallet->role == 'client' && $wallet->user_id == $userId) {
        if (Hash::check($request->input('wallet_password'), $wallet->wallet_password)) {
          $balance = Wallet::where('wallet_number', $number)->pluck('balance')->first();
          if ($balance >= $order_price) {
            $balance -= $order_price;
            event(new WalletBalanceDecreasedClient(
              $number,
              $balance,
              $userId,
              $order_price,
              $id_supplier,
              $id_work,
              $selectedOffers,
              $order_description
            ));
            session()->flash('success_order', 'Payment completed successfully');
            return redirect()->route('View.Order.clinet');
          } else {
            session()->flash('error_balance', 'The balance is insufficient');
            return redirect()->back();
          }
        } else {
          session()->flash('error_password', 'Password Error');
          return redirect()->back();
        }
      }
    } else
      session()->flash('error_wallet', 'Wallet Number Error');
    return redirect()->back();
  }
  //=======================================================================================================================

  public function ViewOrdersClient()
  {
    $userId = session('Client_user_id');
    $info = Order::where('client_id', $userId)
      ->get();
    return view('Client.Settings.Order.ViewOrders', compact('info'));
  }
  //=======================================================================================================================

  public function ViewOrdersSupplier()
  {
    $userId = session('supplier_user_id');
    $info = Order::where('supplier_id', $userId)
      ->whereNot('supplier_status', 'rejection')
      ->get();
    return view('Supplier.Home.Order.ViewOrder', compact('info'));
  }
  //=======================================================================================================================

  public function ViewDetailOrder($id)
  {
    $userId = session('supplier_user_id');
    $TestOrder = Order::where('supplier_id', $userId)
      ->where('id', $id)
      ->where('supplier_status', 'waitings')
      ->first();
    if ($TestOrder) {
      $selectedOfferIds = explode(',', $TestOrder->selected_offers);
      $selectedOffers = WorkExtra::whereIn('id', $selectedOfferIds)->get();
      return view('Supplier.Home.Order.ViewDetails', compact('TestOrder', 'selectedOffers'));
    } else {
      $TestOrder = Order::where('supplier_id', $userId)
        ->where('id', $id)
        ->whereNot('supplier_status', 'waitings')
        ->first();
      $selectedOfferIds = explode(',', $TestOrder->selected_offers);
      $selectedOffers = WorkExtra::whereIn('id', $selectedOfferIds)->get();
      $OrderFile = OrderFile::where('order_id',$id)->get();
      return view('Supplier.Home.Order.DeliveredOrder', compact('TestOrder', 'selectedOffers','OrderFile'));
    }
  }
  //=======================================================================================================================

  public function AcceptanceOrder($id)
  {
    $userId = session('supplier_user_id');
    $accept = Order::where('supplier_id', $userId)
      ->where('id', $id)
      ->where('supplier_status', 'waitings')
      ->first();
    if ($accept) {
      $updated = Order::where('supplier_id', $userId)
        ->where('id', $id)
        ->where('supplier_status', 'waitings')
        ->update(['supplier_status' => 'acceptance']);
      session()->flash('acceptance_order', 'The order was accepted successfully');
      return redirect()->back();
    } else {
      session()->flash('already_acceptance_order', 'Order accepted in already');
      return redirect()->back();
    }
  }
  //=======================================================================================================================

  public function RejectionOrder($id)
  {
    $userId = session('supplier_user_id');
    $Rejection = Order::where('supplier_id', $userId)
      ->where('id', $id)
      ->where('supplier_status', 'waitings')
      ->first();
    if ($Rejection) {
      $updated = Order::where('supplier_id', $userId)
        ->where('id', $id)
        ->where('supplier_status', 'waitings')
        ->update(['supplier_status' => 'rejection']);
      event(new WalletBalanceRefundedClient(
        $Rejection
      ));
      session()->flash('rejection_order', 'The order was rejection successfully');
      return redirect()->back();
    } else {
      session()->flash('already_acceptance_order_after_accept', 'The request has already been accepted, you cannot modify it');
      return redirect()->back();
    }
  }
  //=======================================================================================================================

  public function completedOrder($id)
  {
    $userId = session('supplier_user_id');
    $completed = Order::where('supplier_id', $userId)
      ->where('id', $id)
      ->where('supplier_status', 'acceptance')->first();
    if ($completed) {
      Order::where('supplier_id', $userId)
        ->where('id', $id)
        ->where('supplier_status', 'acceptance')
        ->update(['supplier_status' => 'completed', 'order_status' => 'delivered']);
      session()->flash('completed_order', 'The order was completed successfully and the client has been notified');
      return redirect()->back();
    } else {
      session()->flash('error_completed_order', 'You must accept the order first before marking it as completed');
      return redirect()->back();
    }
  }
  //=======================================================================================================================

  public function ViewOrderInfoClient($id)
  {
    $userId = session('Client_user_id');
    $TestOrder = Order::where('id', $id)
      ->where('client_id', $userId)->first();
    if ($TestOrder) {
      $selectedOfferIds = explode(',', $TestOrder->selected_offers);
      $selectedOffers = WorkExtra::whereIn('id', $selectedOfferIds)->get();
      $fileorder = OrderFile::where('order_id', $id)
        ->where('status', 'Sample')->get();
        $fileorderFinall = OrderFile::where('order_id', $id)
        ->where('status', 'Finall')->get();
      return view('Client.Settings.Order.DetailOrder', compact('TestOrder', 'selectedOffers', 'fileorder','fileorderFinall'));
    } else {
      return redirect()->back();
    }
  }
  //=======================================================================================================================

  public function DeliveredOrder(Request $request)
  {
    $request->validate([
      'id_order' => 'required|exists:orders,id',
      'sample_file' => 'required|file|mimes:zip,rar',
      'sample_note' => 'nullable|string|max:255',
    ]);
    $filePath = $request->file('sample_file')->store('order_samples', 'public');
    OrderFile::create([
      'order_id' => $request->id_order,
      'file_path' => $filePath,
      'note' => $request->sample_note,
      'status' => 'Sample',
    ]);
    session()->flash('DeliveredOrder', 'The request has been sent');
    return back()->with('success', 'Order delivered successfully.');
  }
  //=======================================================================================================================

  public function ApprovedOrder($id)
  {
    $userId = session('Client_user_id');
    $Approved = Order::where('client_id', $userId)
      ->where('id', $id)->first();
    if ($Approved->order_status != 'approved') {
      if ($Approved->supplier_status == 'completed') {
        if ($Approved) {
          Order::where('client_id', $userId)
            ->where('id', $id)
            ->update(['order_status' => 'approved']);
          event(new WalletBalanceIncreasedSupplier(
            $Approved
          ));
          Chat::where('order_id', $Approved->id)->delete();
          session()->flash('approved_order', ' The order has been approved successfully, Please don’t forget to leave a review at the bottom of the page.');
          return redirect()->back();
        }
      }
    } else {
      session()->flash('wrong_approved_order', 'The order has already been approved, You can only approve an order once.');
      return redirect()->back();
    }
    if ($Approved->supplier_status != 'completed') {
      session()->flash('not_completed_order', 'The order cannot be approved yet, Please wait until the supplier marks it as Completed before proceeding.');
      return redirect()->back();
    }
  }
  //=======================================================================================================================

  public function DeliveredOrderFinall(Request $request)
  {
    $request->validate([
      'id_order' => 'required|exists:orders,id',
      'delivery_file' => 'required|file|mimes:zip,rar',
      'delivery_note' => 'nullable|string|max:255',
    ]);
    $filePath = $request->file('delivery_file')->store('order_deliveries', 'public');
    OrderFile::create([
      'order_id' => $request->id_order,
      'file_path' => $filePath,
      'note' => $request->delivery_note,
      'status' => 'Finall',
    ]);
    session()->flash('DeliveredOrder', 'The request has been sent');
    return back()->with('success', 'Order delivered successfully.');
  }
  //=======================================================================================================================

  public function SendNoteClient(Request $request)
  {
    $request->validate([
      'file_id' => 'required|exists:order_files,id',
      'client_note' => 'nullable|string|max:255',
    ]);
    $orderFile = OrderFile::where('id', $request->file_id)->first();
    $orderFile->client_note = $request->client_note;
    $orderFile->save();
    session()->flash('SendNote', 'Comment sent successfully');
    return redirect()->back();
  }
}
