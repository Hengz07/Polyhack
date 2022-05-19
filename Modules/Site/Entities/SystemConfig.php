<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'item';
    public $incrementing = false;
    protected $keyType = 'string';
}
