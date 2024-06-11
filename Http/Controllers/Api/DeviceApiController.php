<?php

namespace Modules\Notification\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Notification\Entities\Device;
use Modules\Notification\Repositories\DeviceRepository;

class DeviceApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Device $model, DeviceRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
