<?php

namespace Modules\Inotification\Events;

class SendWhatsAppNotification
{
  public $user;
  public $phone;
  public $bot;

  public function __construct($user, $phone, $bot)
  {
    $this->user = $user;
    $this->phone = $phone;
    $this->bot = $bot;
  }
}
