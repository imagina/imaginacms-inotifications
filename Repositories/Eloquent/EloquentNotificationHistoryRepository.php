<?php

namespace Modules\Inotification\Repositories\Eloquent;

use Modules\Inotification\Repositories\NotificationHistoryRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentNotificationHistoryRepository extends EloquentBaseRepository implements NotificationHistoryRepository
{
  public function index($page, $take, $filter, $include){
    //Initialize Query
    $query = $this->model->query();

    /*== RELATIONSHIPS ==*/
    if (count($include)) {
      //Include relationships for default
      $includeDefault = ['notification'];
      $query->with(array_merge($includeDefault, $include));
    }

    /*== RELATIONSHIPS ==*/
    if($filter){
      if(isset($filter->userId)){
        $query->where('user_id', $filter->userId);
      }
    }

    /*=== Order By Created At ===*/
    $query->orderBy('created_at','desc');

    /*=== REQUEST NOTIFICATIONS ===*/
    if ($page) {//Return request with pagination
      $take ? true : $take = 12; //If no specific take, query take 12 for default
      $notifications = $query->paginate($take);
    }else{ //Return request without pagination
      $take ? $query->take($take) : false; //if request to take a limit
      $notifications = $query->get();
    }

    /*=== REQUEST COUNT TOTAL ===*/
    $total = $this->model->selectRaw('COUNT(*) as total');
    if(isset($filter->userId))
      $total->where('user_id',$filter->userId);

    /*=== REQUEST COUNT NEWS ===*/
    $news = $this->model->selectRaw('COUNT(*) as news')->whereNull('viewed_at');
    if(isset($filter->userId))
      $news->where('user_id',$filter->userId);

    /*=== RESPONSE ===*/
    $response = [
      "total" => $total->first()->total,
      "news" => $news->first()->news,
      "notifications" => $notifications
    ];

    return (object)$response;
  }
}
