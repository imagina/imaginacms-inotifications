<?php

namespace Modules\Inotification\Repositories\Eloquent;

use Modules\Inotification\Repositories\NotificationRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentNotificationRepository extends EloquentBaseRepository implements NotificationRepository
{
  public function index($page, $take, $filter, $include){
    //Initialize Query
    $query = $this->model->query();

    /*== RELATIONSHIPS ==*/
    if (count($include)) {
      //Include relationships for default
      $includeDefault = [];
      $query->with(array_merge($includeDefault, $include));
    }

    /*== RELATIONSHIPS ==*/
    if($filter){
      if(isset($filter->userId)){
        $query->whereIn('id', function($query) use($filter){
          $query->select('notification_id')
            ->from('inotification__notification_histories')
            ->where('user_id',$filter->userId);
        });
      }
    }

    /*=== Order By Created At ===*/
    $query->orderBy('created_at','desc');

    /*=== REQUEST ===*/
    if ($page) {//Return request with pagination
      $take ? true : $take = 12; //If no specific take, query take 12 for default
      return $query->paginate($take);
    }else{ //Return request without pagination
      $take ? $query->take($take) : false; //if request to take a limit
      return $query->get();
    }
  }

}
