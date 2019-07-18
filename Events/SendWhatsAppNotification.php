<?php

namespace Modules\Inotification\Events;

class SendWhatsAppNotification
{
  public $user;
  public $phone;
  public $message;

  public function __construct($user, $phone, $message)
  {
    $this->user = $user;
    $this->phone = $phone;
    $this->message = $message;
  }
}
