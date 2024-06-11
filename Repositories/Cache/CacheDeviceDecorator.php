<?php

namespace Modules\Notification\Repositories\Cache;

use Modules\Notification\Repositories\DeviceRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheDeviceDecorator extends BaseCacheCrudDecorator implements DeviceRepository
{
    public function __construct(DeviceRepository $device)
    {
        parent::__construct();
        $this->entityName = 'notification.devices';
        $this->repository = $device;
    }
}
