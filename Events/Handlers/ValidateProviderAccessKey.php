<?php

namespace Modules\Notification\Events\Handlers;

class ValidateProviderAccessKey
{

  public function __construct()
  {

  }

  public function handle($event)
  {
    try {
      $model = $event->model;
      
    } catch (\Exception $e) {
      \Log::info($this->log . "ERROR");
      \Log::info($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
    }
  }

}
