<?php

namespace Modules\Notification\Repositories\Cache;

use Modules\Notification\Repositories\ClientRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheClientDecorator extends BaseCacheDecorator implements ClientRepository
{
    public function __construct(ClientRepository $client)
    {
        parent::__construct();
        $this->entityName = 'notification.clients';
        $this->repository = $client;
    }
}
