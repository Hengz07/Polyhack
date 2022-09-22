<?php

namespace Modules\Ewp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class questions extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'ewp_questions';
    
    protected static function newFactory()
    {
        return \Modules\Ewp\Database\factories\QuestionsFactory::new();
    }
}
