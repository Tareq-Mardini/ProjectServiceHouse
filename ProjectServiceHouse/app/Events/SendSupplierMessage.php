<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel; // استبدال بالـ PrivateChannel
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Models\Client;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class SendSupplierMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $message;

    public function __construct(Chat $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('supplier');
    }

    public function broadcastWith()
    {
        $supplier = Supplier::find($this->message->sender_id);
        $imageUrl = null;
        if ($this->message->image) {
            $imagePath = 'public/' . $this->message->image;
            if (Storage::exists($imagePath)) {
                $imageUrl = asset('storage/' . $this->message->image) . '?t=' . now()->timestamp;
            }
        }
        return [
            'message' => $this->message->message,
            'image_url' => $imageUrl,
            'receiver_id' => $this->message->receiver_id,
            'sender_id' => $this->message->sender_id,
            'role' => $this->message->role,
            'supplier' => [
                'id' => $supplier->id,
                'name' => $supplier->name ?? 'Unknown',
            ],
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }

    public function broadcastAs()
    {
        return 'SupplierClient-message';
    }
}