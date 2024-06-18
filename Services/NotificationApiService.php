<?php

namespace Modules\Notification\Services;


class NotificationApiService
{

    public $notificationP;
    public $log = "Notification::NotificationApiService|";

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
        \Log::info($this->log.'Create');

        //Base Data
        $push = [
            "title" => $data->title,
            "message" => $data->message,
            "link" => $data->link ?? null
        ];

        //Media
        if(isset($data->medias_single)) $push['medias_single'] = $data->medias_single;

        //Extra Data
        if(isset($data->setting)) $push['setting'] =  json_decode(json_encode($data->setting));
        if(isset($data->icon_class)) $push['icon_class'] = $data->icon_class;

        //Optional
        if(isset($data->link)) $push['link'] = $data->link;
        if(isset($data->user_id)) $push['user_id'] = $data->user_id;
        if(isset($data->source)) $push['source'] = $data->source;
        if(isset($data->options)) $push['options'] = $data->options;

        //Set To
        $notificationConf = $this->notificationP->to($data->to);

        //Send notification | Not Provider | Not Type
        //Take default providers
        $result = $notificationConf->push($push);

        return $result;

    }


}
