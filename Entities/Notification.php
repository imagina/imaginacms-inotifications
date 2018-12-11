<?php

namespace Modules\Inotification\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Iprofile\Entities\Profile;
use Modules\Inotification\Entities\NotificationHistory;

class Notification extends Model
{
  protected $table = 'inotification__notifications';
  protected $fillable = [
    'user_id',
    'message',
    'options'
  ];

  public function user()
  {
    $driver = config('asgard.user.config.driver');
    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
  }

  public function profile()
  {
    return $this->belongsTo(
      \Modules\Iprofile\Entities\Profile::class, 'user_id', 'user_id');
  }

  public function notificationHistory()
  {
    return $this->hasMany(NotificationHistory::class);
  }
}
