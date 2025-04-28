<?php

namespace App\Http\Controllers;

use App\Events\WalletBalanceDecreasedClient;
use App\Models\Work;
use App\Models\WorkExtra;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
  public function order($id)
  {
    $works = Work::where('id', $id)->first();
    $offers = WorkExtra::where('work_id', $id)->get();
    return view('Client.Home.Order', compact('works', 'offers'));
  }

  public function test(Request $request)
  {
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
          } else {
            return "noooo";
          }
        } else {
          return 'password error';
        }
      }
    } else
      return  $request->total_price;
  }
}
