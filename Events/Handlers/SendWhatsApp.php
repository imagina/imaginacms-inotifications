<?php

namespace Modules\Inotification\Events\Handlers;

use Twilio\Rest\Client;
use Modules\Inotification\Events\SendWhatsAppNotification;
use Modules\Setting\Contracts\Setting;

class SendWhatsApp
{

  private $setting;

  public function __construct(Setting $setting)
  {
    $this->setting = $setting;
  }

  public function handle(SendWhatsAppNotification $event)
  {
    try{

      $sid = $event->sid;
      $token = $event->token;
      $sender = $event->sender;
      $template = $event->template;
      $user = $event->user;
      $phone = $event->phone;
      $twilio = new Client($sid, $token);

      $whatsapp = $twilio->messages
        ->create($phone,
          array(
            'from' => $sender,
            'body' => str_replace('{$user}', $user, $template),
          )
        );
      return $whatsapp->sid;
    } catch (\Exception $e) {
      return $e->getMessage();
    }

  }
}

