<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\Client;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\CustomerService;
use App\Models\Supplier;

class SendSupplierMessageToAdmin implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @param CustomerService $message
     * @return void
     */
    public function __construct(CustomerService $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new Channel('SupplierToAdmin');
    }

    /**
     * Prepare the data to be broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $Supplier = Supplier::find($this->message->sender_id);
        
        // إنشاء رابط الصورة مع timestamp لمنع الكاش
        $imageUrl = null;
        if ($this->message->image) {
            $imagePath = 'public/' . $this->message->image;
            if (Storage::exists($imagePath)) {
                $imageUrl = asset('storage/' . $this->message->image) . '?t=' . now()->timestamp;
            }
        }

        return [
            'message' => $this->message->message,
            'image_url' => $imageUrl, // استخدمنا image_url بدل image
            'receiver_id' => $this->message->receiver_id,
            'sender_id' => $this->message->sender_id,
            'role' => $this->message->role,
            'Supplier' => [
                'id' => $Supplier->id ?? null,
                'name' => $Supplier->name ?? 'Unknown',
            ],
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }

    /**
     * The name of the event to broadcast.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'SupplierAdmin-message';
    }
}