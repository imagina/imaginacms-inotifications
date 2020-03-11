<?php

namespace Modules\Notification\Repositories\Cache;

use Modules\Notification\Repositories\RuleRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRuleDecorator extends BaseCacheDecorator implements RuleRepository
{
    public function __construct(RuleRepository $rule)
    {
        parent::__construct();
        $this->entityName = 'notification.rules';
        $this->repository = $rule;
    }
}
