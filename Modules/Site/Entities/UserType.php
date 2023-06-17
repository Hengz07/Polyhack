<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class UserType extends Model
{
    protected $connection = 'mysql';

    protected $fillable = [
        'name', 'name_my', 'description',
    ];

    const STAFF = 1;
    const STUDENT = 2;
    const PUCLIC_USER = 3;
    const PUBLIC_ORGANIZATION = 4;

    /**
     * Set the faculty's name ucfirst
     *
     * @param  string  $value
     * @return void
     */
    public function getNameAttribute($value) {
        if (App::isLocale('en')) {
            $name = $value;            
        }
        else if (App::isLocale('ms-my')) {
            $name = $this->name_my;
        }

        return $name;
    }
}