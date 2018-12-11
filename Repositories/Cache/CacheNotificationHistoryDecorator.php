<?php

namespace Modules\Inotification\Repositories\Cache;

use Modules\Inotification\Repositories\NotificationHistoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheNotificationHistoryDecorator extends BaseCacheDecorator implements NotificationHistoryRepository
{
    public function __construct(NotificationHistoryRepository $notificationhistory)
    {
        parent::__construct();
        $this->entityName = 'inotification.notificationhistories';
        $this->repository = $notificationhistory;
    }
}
