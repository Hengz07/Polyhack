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

    public function setCategory($cat)
    {
        $this->schedules['category'] = json_encode($cat);
    }

    public function getCategory($cat)
    {
        return $this->schedules['category'] = json_decode($cat);
    }
}
