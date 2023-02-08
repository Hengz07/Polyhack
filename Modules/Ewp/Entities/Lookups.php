<?php

namespace Modules\Ewp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lookups extends Model   
{
    use HasFactory;

    protected $table = 'lookups';
    protected $fillable = ['key', 'code', 'value_local', 
                            'value_translation', 'desc', 'meta_value'];
    
    protected $casts = [
        'meta_value' => 'array',
    ]; 
}
