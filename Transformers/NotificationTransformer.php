<?php


namespace Modules\Notification\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iprofile\Transformers\UserTransformer;

class NotificationTransformer extends Resource
{
    public function toArray($request)
    {
        $data=[
            'id'=>$this->when($this->id,$this->id),
            'type'=>$this->when($this->type, $this->type),
            'title'=>$this->when($this->title,$this->title),
            'message'=>$this->when($this->message, $this->message),
            'entity'=>$this->when($this->icon_class, $this->icon_class),
            'link'=>$this->when($this->link, $this->link),
            'isRead'=>$this->is_read,
            'timeAgo'=>$this->when($this->timeAgo,$this->timeAgo),
            'created_at'=>$this->when($this->created_at,$this->created_at),
            'updated_at'=>$this->when($this->updated_at,$this->updated_at),
            'user'=>new UserTransformer($this->whenLoaded('user')),
        ];

        return $data;
    }
}