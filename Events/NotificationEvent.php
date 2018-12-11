<?php

namespace Modules\Inotification\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NotificationEvent implements ShouldBroadcastNow
{
  use InteractsWithSockets, SerializesModels;

  public $notification;
  public $userId;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($userId,$notification)
  {
    $this->notification = $notification;
    $this->userId = $userId;
  }


  public function broadcastWith()
  {
    // This must always be an array. Since it will be parsed with json_encode()
    return [
      "data" => $this->notification
    ];
  }

  public function broadcastAs()
  {
    return 'notification'.$this->userId;
  }

  /**
   * Get the channels the event should be broadcast on.
   *
   * @return array
   */
  public function broadcastOn()
  {
    return new Channel('global');
  }
}
