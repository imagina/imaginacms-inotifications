<?php

namespace Modules\Inotification\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class StorageBroadcastingEvent implements ShouldBroadcastNow
{
  use InteractsWithSockets, SerializesModels;
  
  public $key;
  
  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($key)
  {
    $this->key = $key;
  }

  
  public function broadcastWith()
  {
    // This must always be an array. Since it will be parsed with json_encode()
    return [
      "key" => $this->key
    ];
  }
  
  public function broadcastAs()
  {
    return 'clearCache';
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
