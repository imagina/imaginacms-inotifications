<?php

namespace Modules\Inotification\Repositories\Cache;

use Modules\Inotification\Repositories\PlatformRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePlatformDecorator extends BaseCacheDecorator implements PlatformRepository
{
    public function __construct(PlatformRepository $platform)
    {
        parent::__construct();
        $this->entityName = 'inotification.platforms';
        $this->repository = $platform;
    }
}
