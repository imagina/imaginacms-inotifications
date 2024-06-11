<?php

namespace Modules\Notification\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Media\Support\Traits\MediaRelation;

/**
 * @property string type
 * @property string message
 * @property string icon_class
 * @property string title
 * @property string link
 * @property bool is_read
 * @property \Carbon\Carbon created_at
 * @property \Carbon\Carbon updated_at
 * @property int user_id
 */
class Notification extends Model
{

  use MediaRelation;

  protected $table = 'notification__notifications';
  protected $fillable = [
    'user_id',
    'type',
    'message',
    'icon_class',
    'link',
    'is_read',
    'title',
    'provider',
    'recipient',
    'options',
    'is_action',
    'source'
  ];
  
  protected $appends = ['time_ago'];
  protected $casts = ['is_read' => 'bool', 'options' => 'array'];
  
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    $driver = config('asgard.user.config.driver');
    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
  }

  public function recipientUser()
  {
    $driver = config('asgard.user.config.driver');
    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User", "recipient");
  }
  
  /**
   * Return the created time in difference for humans (2 min ago)
   * @return string
   */
  public function getTimeAgoAttribute()
  {
    return !empty($this->created_at) ? $this->created_at->diffForHumans() : 0;
  }
  
  public function isRead(): bool
  {
    return $this->is_read === true;
  }
  
  public function getOptionsAttribute($value)
  {
    return json_decode($value);
  }
  
  public function setOptionsAttribute($value)
  {
    $this->attributes['options'] = json_encode($value);
  }
}
