<?php

namespace Modules\Notification\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

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
  public $unRead;
  public $user;
  public $target;
  public $componentId;

  public function mount($idNotificationIndicator = null,
                        $icon = "fa-solid fa-bell",
                        $iconFont = "1.1rem",
                        $iconClass = "",
                        $colorIcon = "var(--primary)",
                        $colorBadge = "#FF0000",
                        $notiClass = "px-2",
                        $notiStyle = null,
                        $target="_blank")
  {
    $this->componentId = 'livewireNotificationIndicator' . rand(0, 99);
    $this->idNotificationIndicator = $idNotificationIndicator ?? uniqid('notification');
    $this->icon = $icon;
    $this->iconFont = $iconFont;
    $this->iconClass = $iconClass;
    $this->colorIcon = $colorIcon;
    $this->colorBadge = $colorBadge;
    $this->notiClass = $notiClass;
    $this->notiStyle = $notiStyle;
    $this->target = $target;
  }

  public function render()
  {
    return view("notification::frontend.livewire.dynamic-notification-indicator");
  }
}
