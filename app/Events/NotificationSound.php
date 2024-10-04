<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationSound
{
    use Dispatchable, SerializesModels;

    public $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function broadcastOn(): string
    {
        // Return the channel name where the event should be broadcast
        return 'notifications';
    }

    public function broadcastAs(): string
    {
        // Return a unique event name
        return 'play-sound';
    }

    public function broadcastWith(): array
    {
        // Return any additional data you want to send with the event
        return [
            'orderId' => $this->orderId,
        ];
    }
}
