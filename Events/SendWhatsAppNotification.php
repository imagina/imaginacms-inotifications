<?php

namespace Modules\Inotification\Events;

class SendWhatsAppNotification
{
  
  public $sid, $token, $sender, $template, $user, $phone;

  public function __construct($sid, $token, $sender, $template, $user, $phone)
  {
    $this->sid = $sid;
    $this->token = $token;
    $this->sender = $sender;
    $this->template = $template;
    $this->user = $user;
    $this->phone = $phone;
  }
}
