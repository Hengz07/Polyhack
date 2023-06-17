<?php

namespace Modules\Site\Entities;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $connection = 'mysql';
    protected $fillable = [
        'menu_id',
        'text', 
        'url', 
        'can', 
        'active', 
        'icon',
        'seq', 
        'top_nav',
        'topnav_right', 
        'is_active',
    ];    

    //each category might have one parent
    public function parent()
    {
        return $this->belongsTo('App\Models\System\Menu', 'menu_id');
    }

    //each category might have multiple children
    public function children()
    {
        return $this->hasMany('App\Models\System\Menu', 'menu_id')->orderBy('seq', 'asc');
    }

    /**
     * Scope a query to only include active menus.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Scope a query to only include menu with menu_id is null.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsParent($query)
    {
        return $query->whereNull('menu_id');
    }
}