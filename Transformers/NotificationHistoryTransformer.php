<?php

namespace Modules\Inotification\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class NotificationHistoryTransformer extends Resource
{
  public function toArray($request)
  {
    return [
      "id" => $this->id,
      "message" => $this->notification->message,
      "options" => json_decode($this->notification->options),
      "user" => [
        "fullName" => $this->notification->user->present()->fullname,
        "mainimage" => $this->notification->profile->mainimage
      ],
      "date" => $this->notification->created_at,
      "viewedDate" => $this->viewed_at
    ];
  }
}
