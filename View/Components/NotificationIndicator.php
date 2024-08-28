<?php

namespace Modules\Notification\View\Components;

use Illuminate\View\Component;

class NotificationIndicator extends Component
{
  public $id;
  public $icon;
  public $iconFont;
  public $iconClass;
  public $colorIcon;
  public $colorBadge;
  public $route;
  public $notiClass;
  public $notiStyle;
  public $unRead;
  public $user;
  public $target;

  public function __construct($id = null,
                              $icon = "fa-solid fa-bell",
                              $iconFont = "1.1rem",
                              $iconClass = "",
                              $colorIcon = "var(--primary)",
                              $colorBadge = "#FF0000",
                              $route = "#",
                              $notiClass = "px-2",
                              $notiStyle = null,
                              $target="_blank"
  )
  {
    $this->id = $id ?? uniqid('notification');
    $this->icon = $icon;
    $this->iconFont = $iconFont;
    $this->iconClass = $iconClass;
    $this->colorIcon = $colorIcon;
    $this->colorBadge = $colorBadge;
    $this->route = $route;
    $this->notiClass = $notiClass;
    $this->notiStyle = $notiStyle;
    $this->target = $target;

    $this->route = url('/iadmin/#/notifications/me');

    $this->user = \Auth::user() ?? null;
    $this->unRead = false; //default value
    $this->getUnread();
   
  }


  public function notificationRepository()
  {
    return app('Modules\Notification\Repositories\NotificationRepository');
  }

  private function getUnread()
  {   
     
      if(!is_null($this->user)){
        $params = ['filter' => ['recipient' => $this->user->id,'type' => 'broadcast', 'read' => 0 ],'include' => [],'take' => 1];
        $unreadNotifications = $this->notificationRepository()->getItemsBy(json_decode(json_encode($params)));

        if(count($unreadNotifications)>0) $this->unRead = true;
      }

  }

  public function render()
  {
    return view("notification::frontend.components.notification-indicator");
  }
}
