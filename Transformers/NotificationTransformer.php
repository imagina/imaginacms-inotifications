<?php

namespace Modules\Inotification\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class NotificationTransformer extends Resource
{
  public function toArray($request)
  {
    return [
      "message" => $this->message,
      "options" => json_decode($this->options),
      "user" => [
        "fullName" => $this->user->present()->fullname,
        "mainimage" => $this->profile->mainimage
      ],
      "date" => $this->created_at,
      "viewedDate" => false
    ];
  }
}
