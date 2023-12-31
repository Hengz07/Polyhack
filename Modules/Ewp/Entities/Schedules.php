<?php

namespace Modules\Ewp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedules extends Model
{
    use HasFactory;

    protected $table    = 'ewp_calendar';
    protected $fillable = ['session', 'semester', 'status', 'category', 
                           'remark', 'start_date', 'end_date'];

    public function profile()
    {
        return $this->belongsTo('Modules\Site\Entities\Profile');
    }

    public function user()
    {
        return $this->belongsTo('Modules\Site\Entities\User');
    }
}