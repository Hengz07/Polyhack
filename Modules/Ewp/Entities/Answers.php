<?php

namespace Modules\Ewp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answers extends Model
{
    use HasFactory;

    protected $table    = 'ewp_answer';
    protected $fillable = ['session', 'report_id', 'sem', 'meta', 'date_taken'];

    protected $casts = [
        'meta' => 'array',
    ]; 

    public function report()
    { 
        return $this->belongsTo(Reports::class, 'id');
    }
}