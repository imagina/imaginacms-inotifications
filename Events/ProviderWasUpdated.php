<?php

namespace Modules\Notification\Events;

class ProviderWasUpdated
{
  public $model;

  /*
  *  updatedWithBindings Params - From Entity
  */
  public function __construct($model = null)
  {
    $this->model = $model;
  }

}