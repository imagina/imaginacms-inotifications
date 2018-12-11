<?php

namespace Modules\Inotification\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface NotificationHistoryRepository extends BaseRepository
{
  public function index($page, $take, $filter, $include);
}
