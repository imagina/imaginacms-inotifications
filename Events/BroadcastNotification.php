<?php

namespace Modules\Notification\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;
use Modules\Notification\Entities\Notification;

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

    public function broadcastAs()
    {
        if($this->notification->user_id){
            return 'notification.new.'.$this->notification->user_id;
        }else{
            return 'notification.new';
        }

    }

    /**
     * Get the channels the event should broadcast on.
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('imagina.notifications');
    }

}
