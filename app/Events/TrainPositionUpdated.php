<?php

namespace App\Events;

use App\Models\Train; // تأكدي من وجود هذا السطر لاستدعاء الموديل
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrainPositionUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $train;

    public function __construct(Train $train)
    {
        $this->train = $train;
    }

    public function broadcastOn()
    {
        return new Channel('trains');
    }

    public function broadcastAs()
    {
        return 'position.updated';
    }
}