<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id', 
        'profile_no', 
        'ptj', 
        'department', 
        'status',
        'position', 
        'grade', 
        'employment_type', 
        'academic', 
        'meta',
        'alt_email',
        'alt_phone'
    ];

    protected $casts = [
        'ptj' => 'array',
        'department' => 'array',
        'status' => 'array',
        'position' => 'array',
        'grade' => 'array',
        'employment_type' => 'array',
        'academic' => 'array',
        'meta' => 'array',
    ]; 

    public function getGradeDescAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    ## RELATIONSHIP
    
    /**
     * Get the user that owns the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reports()
    {
        return $this->hasMany(Reports::class, 'id');
    }

    public function schedules()
    {
        return $this->hasMany('Modules\Ewp\Entities\Schedules');
    }

    /**
     * Get the faculty that owns the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ptj()
    {
        return $this->belongsTo(Ptj::class);
    }

    /**
     * Get the department that owns the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
