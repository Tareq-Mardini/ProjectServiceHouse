<?php

namespace App\Events;

use App\Models\Order;
use App\Models\Wallet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;
class WalletBalanceRefundedClient
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($Rejection)
    {
        $WalletClient = Wallet::where('user_id',$Rejection->client_id)
        ->where('role','client')
        ->first();
        if($WalletClient){
            $WalletClient->balance += $Rejection->price;
            $WalletClient->save();
        }
        $WalletSystem = Wallet::where('user_id',0)
        ->where('role','System')->first();
        if($WalletSystem){
            $WalletSystem->balance -= $Rejection->price;
            $WalletSystem->save();
        }
        Transaction::create([
            'order_id' => $Rejection->id,
            'sender_id' => 0,
            'receiver_id' => $Rejection->client_id,
            'receiver_role' => 'client',
            'status' => 'The money has been returned to the client',
            'amount' => $Rejection->price
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
