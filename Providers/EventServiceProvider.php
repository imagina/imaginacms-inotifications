<?php

namespace Modules\Inotification\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Modules\Inotification\Events\Handlers\SendWhatsApp;
use Modules\Inotification\Events\SendWhatsAppNotification;

class EventServiceProvider extends ServiceProvider
{
  protected $listen = [
    SendWhatsAppNotification::class => [
      SendWhatsApp::class,
    ],
  ];
}
