<?php

namespace Modules\Ewp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reports extends Model
{
    use HasFactory;

    protected $table    = 'ewp_overall_report';
    protected $fillable = ['session', 'sem', 'profile_id', 'status', 'scale'];     

    /**
     * Get the faculty that owns the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'id');
    }
}

