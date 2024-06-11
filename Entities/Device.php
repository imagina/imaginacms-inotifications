<?php

namespace Modules\Notification\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Device extends CrudModel
{
  use Translatable;
  
  protected $table = 'notification__devices';
  public $transformer = 'Modules\Notification\Transformers\DeviceTransformer';
  public $requestValidation = [
    'create' => 'Modules\Notification\Http\Requests\CreateDeviceRequest',
    'update' => 'Modules\Notification\Http\Requests\UpdateDeviceRequest',
  ];
  //Instance external/internal events to dispatch with extraData
  public $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [],
    'creating' => [],
    'updated' => [],
    'updating' => [],
    'deleting' => [],
    'deleted' => []
  ];
  public $translatedAttributes = [];
  protected $fillable = [
    "user_id",
    "device",
    "token",
    "provider_id"
  ];
}
