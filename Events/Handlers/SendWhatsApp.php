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
    $sid = env('TWILIO_ACCOUNT_SID', $this->setting->get('inotification::twilio-account-sid'));
    $token = env('TWILIO_AUTH_TOKEN', $this->setting->get('inotification::twilio-auth-token'));
    $sender = env('TWILIO_SENDER', $this->setting->get('inotification::twilio-sender'));
    $twilio = new Client($sid, $token);

    try{
      $user = $event->user;
      $phone = $event->phone;
      $message = $event->message;

      $whatsapp = $twilio->messages
        ->create($phone,
          array(
            'from' => $sender,
            'body' => str_replace('{$user}', $user, $message), //"$message"
          )
        );
      return $whatsapp->sid;
    } catch (\Exception $e) {
      return $e->getMessage();
    }

  }
}

