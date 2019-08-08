<?php

namespace Modules\Inotification\Events\Handlers;

use Twilio\Rest\Client;
use Modules\Inotification\Events\SendWhatsAppNotification;
use Modules\Setting\Contracts\Setting;

class SendWhatsApp
{

  private $twilio;
  private $sid;
  private $token;
  private $sender;
  private $setting;

  public function __construct(Setting $setting)
  {
    $this->setting = $setting;
  }

  public function handle(SendWhatsAppNotification $event)
  {
    $sid = $event->bot->twilio_account_sid;
    $token = $event->bot->twilio_auth_token;
    $sender = $event->bot->twilio_sender;
    $twilio = new Client($sid, $token);

    try{
      $user = $event->user;
      $phone = $event->phone;
      $message = $event->bot->init_message;

      $whatsapp = $twilio->messages
        ->create($phone,
          array(
            'from' => $sender,
            'body' => str_replace('{$user}', $user, $message),
          )
        );
      return $whatsapp->sid;
    } catch (\Exception $e) {
      return $e->getMessage();
    }

  }
}

