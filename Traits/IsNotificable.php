<?php

namespace Modules\Notification\Traits;

trait IsNotificable
{
  
  public $log = "Notification::Traits|IsNotificable|";
 
  public static function bootIsNotificable()
  {

    //Created
    static::created(function ($model) {
      //Get Params From Model
      $params = $model->isNotificableParams("created");

      //Validation
      if(!is_null($params) && isset($params['created'])){
        $model->notificationProcess($params['created'],$model);
      }
    });

    //Updated
    static::updated(function ($model) {
      //Get Params From Model
      $params = $model->isNotificableParams("updated");

      //Validation
      if(!is_null($params) && isset($params['updated'])){
        $model->notificationProcess($params['updated'],$model);
      }
    });

    //Deleted
    static::deleted(function ($model) {
      //Get Params From Model
      $params = $model->isNotificableParams("deleted");

      //Validation
      if(!is_null($params) && isset($params['deleted'])){
        $model->notificationProcess($params['deleted'],$model);
      }
    });

   
  }

  /**
   * 
   */
  public function notificationProcess($params,$model)
  {
    
    try {

      $notificationService = app("Modules\Notification\Services\Inotification");

      //Default
      $title = isset($params['title']) ? $params['title'] : trans("notification::common.default.title");
      $message = isset($params['message']) ? $params['message'] : trans("notification::common.default.message");

      //Destinations
      if(isset($params['email'])) $to['email'] = $params['email']; else throw new \Exception("Email Required", 500);
      if(isset($params['broadcast'])) $to['broadcast'] = $params['broadcast'];

      //Set Base Params
      $push = [
        "title" => $title,
        "message" => $message,
        "setting" => ["saveInDatabase" => 1],
      ];

      //Optional
      if(isset($params['userId'])) $push['user_id'] = $params['userId'];

      //Custom Layout
      if(isset($params['content'])) $push['content'] = $params['content'];
      if(isset($params['layout'])) $push['layout'] = $params['layout'];

      //Extras
      if(isset($params['extraParams'])) $push['extraParams'] = $params['extraParams'];

      //Send Notification
      $notificationService->to($to)->push($push);

    } catch (\Exception $e) {
      \Log::error($this->log.'Message: ' . $e->getMessage() . ' | FILE: ' . $e->getFile() . ' | LINE: ' . $e->getLine());
    }
   

  }

}