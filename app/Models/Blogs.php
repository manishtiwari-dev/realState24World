<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = "blog";

    public function getTagsAttribute()
    {
        return BlogTag::whereIn('id', json_decode($this->tag_id ?? '[]'))->get();
    }
}
