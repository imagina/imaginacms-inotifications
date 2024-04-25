<?php

namespace Modules\Notification\Services;


class NotificationApiService
{   

    public $notificationP;

    /**
     * 
     */
    public function __construct()
    {
        $this->notificationP = app("Modules\Notification\Services\Inotification");
    }

    /**
     * Create | Send Notification | Save Notification
     */
    public function create($data)
    {

        //Base Data
        $push = [
            "title" => $data->title,
            "message" => $data->message,
            "link" => $data->link ?? url('')
        ];

        //Extra Data
        if(isset($data->setting)) $push['setting'] =  json_decode(json_encode($data->setting));
        if(isset($data->icon_class)) $push['icon_class'] = $data->icon_class;
        
        //Set To
        $notificationConf = $this->notificationP->to($data->to);

        //Send notification | Not Provider | Not Type
        //Take default providers
        $result = $notificationConf->push($push);

        return $result;

    }


}