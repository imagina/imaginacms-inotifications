<?php

namespace Modules\Notification\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class  Client extends Model
{
    use Translatable;

    protected $table = 'notification__clients';
    public $translatedAttributes = [];
    protected $fillable = [];
}
