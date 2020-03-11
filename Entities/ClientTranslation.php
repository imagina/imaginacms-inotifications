<?php

namespace Modules\Notification\Entities;

use Illuminate\Database\Eloquent\Model;

class ClientTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'notification__client_translations';
}
