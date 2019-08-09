<?php

namespace Modules\Inotification\Events;

use Illuminate\Queue\SerializesModels;
use Twilio\Rest\Client;

class SendWhatsapp
{
  use SerializesModels;

  public $phone;
  public $fullName;
  private $twilioClient;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($codeCountry, $phone, $fullName, Client $twilioClient)
  {
    $this->phone = '+'.$codeCountry.$phone;
    $this->fullName = $fullName;
    $this->twilioClient = $twilioClient;
  }

  /**
   * Get the channels the event should be broadcast on.
   *
   * @return array
   */
  public function broadcastOn()
  {
      return [];
  }
}
