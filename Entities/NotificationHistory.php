<?php

namespace Modules\Inotification\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Inotification\Entities\Notification;

class NotificationHistory extends Model
{

  protected $table = 'inotification__notification_histories';
  protected $fillable = [
    'notification_id',
    'user_id',
    'platform_id',
    'viewed_at'
  ];

  public function notification()
  {
    return $this->belongsTo(Notification::class);
  }
}
