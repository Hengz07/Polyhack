<?php

namespace Modules\Ewp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use Modules\Site\Entities\Profile;

class Reports extends Model
{
    use HasFactory;

    protected $table    = 'ewp_overall_report';
    protected $fillable = ['session', 'sem', 'profile_id', 'status', 'scale', 'intervention'];     

    protected $casts = [
        'scale' => 'array',
    ]; 
    
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function assign()
    { 
        return $this->hasOne(Assign::class, 'report_id');
    }

    public function answer()
    { 
        return $this->hasOne(Answers::class, 'report_id');
    }
}

