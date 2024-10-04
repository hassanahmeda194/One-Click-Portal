<?php

namespace App\Listeners;

use App\Events\NotificationCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PlayNotificationSound implements ShouldQueue
{
    public function __construct()
    {}
    public function handle(NotificationCreated $event): array
    {
        Log::info('NotificationCreated event received: ' . $event->orderId);

        return [
            'sound_url' => asset('notification.mp3'),
        ];
    }
}
