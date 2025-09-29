<?php

namespace Modules\Notification\Events;

class ProviderWasCreated
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