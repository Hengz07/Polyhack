<?php

namespace Modules\Ewp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Site\Entities\User;

class Assign extends Model
{
    use HasFactory;

    protected $table    = 'ewp_assign';
    protected $fillable = ['report_id', 'officer_id', 'status'];

    public function report()
    { 
        return $this->belongsTo(Reports::class, 'id');
    }

    public function user()
    { 
        return $this->belongsTo(User::class, 'id');
    }
}