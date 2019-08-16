<?php

namespace Modules\Inotification\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;

class NotificationTransformer extends Resource
{
    public function toArray($request)
    {
        $data = [
            'title' => $this->when($this->title, $this->title),
            'type' => $this->when($this->type, $this->type),
            'message' => $this->when($this->message, $this->type),
            'iconClass' => $this->when($this->icon_class, $this->icon_class),
            'link' => $this->when($this->link, $this->link),
            'isRead' => $this->when($this->is_read, $this->is_read),

            'user' => new UserProfileTransformer($this->whenLoaded('user'))

        ];


        return $data;

    }
}
