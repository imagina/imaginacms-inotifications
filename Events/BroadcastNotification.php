<?php

namespace Modules\Notification\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;
use Modules\Notification\Entities\Notification;
use Modules\Notification\Transformers\NotificationTransformer;

class BroadcastNotification implements ShouldBroadcast, ShouldQueue
{
    use SerializesModels;

    /**
     * @var Notification
     */
    public $notification;
    public $payload;

    public function __construct(Notification $notification, $payload)
    {
        $this->notification = $notification;
        $this->payload = $payload;
    }

    public function broadcastWith(){

        $data=[
            'created_at'=>$this->notification->created_at,
            'entity'=>$this->notification->icon_class,
            'id'=>$this->notification->id,
            'link'=>$this->notification->link,
            'message'=>$this->notification->message,
            'timeAgo'=>$this->notification->timeAgo,
            'title'=>$this->notification->title,
            'type'=> $this->notification->type,
            'updated_at'=>$this->notification->updated_at,
            'user'=>$this->notification->user_id,
            'recipient'=>$this->notification->recipient
        ];
        $data = array_merge($data,$this->payload);
        
        return $data;
    }

    public function broadcastAs()
    {
        if($this->notification->recipient){
            return 'notification.new.'.$this->notification->recipient;
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
