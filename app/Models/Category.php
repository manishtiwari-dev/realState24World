<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'shortdescription',
        'description',
        'thumbnail',
        'banner',
        'metatitle',
        'metakeyword',
        'metadescription',
        'display_order',
        'status',
    ];

    public function subsubcategory()
    {
        return $this->hasMany(\App\Models\Category::class, 'parent_id');
    }

    public function subcategory()
    {
        return $this->hasMany(\App\Models\Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parent_id');
    }
}
