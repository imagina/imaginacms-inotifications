<?php

namespace Modules\Inotification\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Inotification\Entities\Notification;

class BroadcastNotification implements ShouldBroadcast, ShouldQueue
{
    use SerializesModels;

    /**
     * @var Notification
     */
    public $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Get the channels the event should broadcast on.
     * @return array
     */
    public function broadcastOn()
    {
        return ['imagina.notifications.' . $this->notification->user_id];
    }
}
