<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function state()
    {
        return $this->belongsTo(\App\Models\State::class);
    }

      public function property()
    {
        return $this->hasMany(Properties::class, 'project_id','id');
    }

     public function reviews()
    {
        return $this->hasMany(Review::class, 'property_id');
    }

}
