<?php

namespace App\Events;

use App\Models\Supplier;
use App\Models\Wallet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\Transaction;

class WalletBalanceIncreasedSupplier
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($Approved)
    { 
        $amount = $Approved->price;
        $fee = $amount * 0.02;
        $finalAmount = $amount - $fee;
        $wallet = Wallet::where('user_id', $Approved->supplier_id)
            ->where('role', 'supplier')
            ->first();
        if ($wallet) {
            $wallet->balance += $finalAmount;
            $wallet->save();
        }
        $WalletSystem = Wallet::where('user_id',0)
        ->where('role','System')
        ->first();
        if($WalletSystem){
            $WalletSystem->balance -= $finalAmount;
            $WalletSystem->balance += $fee;
            $WalletSystem->save();
        }
        $ReleasedToSupplier = Order::where('id',$Approved->id)
        ->first();
        if($ReleasedToSupplier){
            $ReleasedToSupplier->payment_status = 'released_to_supplier';
            $ReleasedToSupplier->save();
        }
        Transaction::create([
            'order_id' => $Approved->id,
            'sender_id' => 0,
            'receiver_id' => $Approved->supplier_id,
            'receiver_role' => 'supplier',
            'status' => 'The money has been transferred to the supplier',
            'amount' => $finalAmount
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
