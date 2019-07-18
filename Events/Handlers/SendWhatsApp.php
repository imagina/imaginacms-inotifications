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
    $this->twilio = new Client($this->sid, $this->token);
    $this->sid = env('TWILIO_ACCOUNT_SID', '');
    $this->token = env('TWILIO_AUTH_TOKEN', '');
    $this->sender = env('TWILIO_SENDER', '');
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
            'body' => "Hola *$user*, $message"
          )
        );
      return $whatsapp->sid;
    } catch (\Exception $e) {
      return $e->getMessage();
    }

  }
}

