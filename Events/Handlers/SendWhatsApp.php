<?php

namespace Modules\Inotification\Events\Handlers;

use Twilio\Rest\Client;
use Modules\Inotification\Events\SendWhatsAppNotification;

class SendWhatsApp
{

  private $twilio;
  private $sid;
  private $token;
  private $sender;

  public function __construct()
  {
    $this->sid = env('TWILIO_ACCOUNT_SID', '');
    $this->token = env('TWILIO_AUTH_TOKEN', '');
    $this->sender = env('TWILIO_SENDER', '');
    $this->twilio = new Client($this->sid, $this->token);
  }

  public function handle(SendWhatsAppNotification $event)
  {
    try{
      $user = $event->user;
      $phone = $event->phone;
      $message = $event->message;

      $whatsapp = $this->twilio->messages
        ->create($phone,
          array(
            'from' => $this->sender,
            'body' => str_replace('{$user}', $user, $message), //"$message"
          )
        );
      return $whatsapp->sid;
    } catch (\Exception $e) {
      return $e->getMessage();
    }

  }
}

