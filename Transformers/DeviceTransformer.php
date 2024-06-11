<?php

namespace Modules\Notification\Transformers;

use Modules\Core\Icrud\Transformers\CrudResource;

class DeviceTransformer extends CrudResource
{
  /**
  * Method to merge values with response
  *
  * @return array
  */
  public function modelAttributes($request)
  {
    return [];
  }
}
