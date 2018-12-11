<?php

namespace Modules\Inotification\Repositories\Cache;

use Modules\Inotification\Repositories\NotificationRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheNotificationDecorator extends BaseCacheDecorator implements NotificationRepository
{
    public function __construct(NotificationRepository $notification)
    {
        parent::__construct();
        $this->entityName = 'inotification.notifications';
        $this->repository = $notification;
    }
}
