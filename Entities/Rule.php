<?php

namespace Modules\Notification\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use Translatable;

    protected $table = 'notification__rules';
    public $translatedAttributes = [];
    protected $fillable = [];
}
