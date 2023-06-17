<?php

namespace Modules\Site\Entities;

use Spatie\Permission\Models\Permission as BaseModel;

class Permission extends BaseModel
{
    protected $connection = 'mysql';
    //each category might have one parent
    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }

    //each category might have multiple children
    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id')->orderBy('id', 'asc');
    }
}