<?php

namespace Modules\Notification\Http\Livewire;

use Livewire\Component;

class DynamicNotificationIndicator extends Component
{
  public $idNotificationIndicator;
  public $icon;
  public $iconFont;
  public $iconClass;
  public $colorIcon;
  public $colorBadge;
  public $route;
  public $notiClass;
  public $notiStyle;
  public $unRead = false;
  public $user;
  public $target;

  public function mount(
    $idNotificationIndicator = null,
    $icon = "fa-solid fa-bell",
    $iconFont = "1.1rem",
    $iconClass = "",
    $colorIcon = "var(--primary)",
    $colorBadge = "#FF0000",
    $route = "#",
    $notiClass = "px-2",
    $notiStyle = null,
    $target = "_blank"
  ) {
    $this->idNotificationIndicator = $idNotificationIndicator ?? uniqid('notification');
    $this->icon = $icon;
    $this->iconFont = $iconFont;
    $this->iconClass = $iconClass;
    $this->colorIcon = $colorIcon;
    $this->colorBadge = $colorBadge;
    $this->route = url('/iadmin/#/notifications/me');
    $this->notiClass = $notiClass;
    $this->notiStyle = $notiStyle;
    $this->target = $target;
  }

  public function notificationRepository()
  {
    return app('Modules\Notification\Repositories\NotificationRepository');
  }

  public function getUnread()
  {
    $this->user = \Auth::user() ?? null;

    if (!is_null($this->user)) {
      $params = [
        'filter' => [
          'recipient' => $this->user->id,
          'type'      => 'broadcast',
          'isRead'    => 0,
        ],
        'include' => [],
        'take'    => 1,
      ];

      $unreadNotifications = $this->notificationRepository()->getItemsBy(
        json_decode(json_encode($params))
      );

      $this->unRead = count($unreadNotifications) > 0;
    }
  }

  public function render()
  {
    return view("notification::frontend.livewire.dynamic-notification-indicator");
  }
}
