<?php

namespace App\Events;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Wallet;

class WalletBalanceDecreasedClient
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */


    public function __construct($number, $balance, $userId, $order_price, $id_supplier, $id_work, $selectedOffers, $order_description)
    {
        Wallet::where('wallet_number', $number)
            ->where('role', 'client')
            ->update([
                'balance' => $balance
            ]);
        $plus_price = Wallet::where('wallet_number', 'SH-HMTM-0000')
            ->where('role', 'System')
            ->first();
        Wallet::where('wallet_number', 'SH-HMTM-0000')
            ->where('role', 'System')
            ->update([
                'balance' => $order_price + $plus_price->balance
            ]);
        $order = Order::create([
            'work_id' => $id_work,
            'client_id' => $userId,
            'supplier_id' => $id_supplier,
            'price' => $order_price,
            'order_description'=> $order_description,
            'selected_offers' => implode(',', $selectedOffers),
        ]);
        Transaction::create([
            'order_id' => $order->id,
            'sender_id' => $userId,
            'receiver_id' => 0,
            'receiver_role' => 'system',
            'status' => 'The money is in the system',
            'amount' => $order_price
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
