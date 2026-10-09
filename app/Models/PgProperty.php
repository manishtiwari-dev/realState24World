<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PgProperty extends Model
{
    protected $table = "pg_property";

    public function state()
    {
        return $this->belongsTo(\App\Models\State::class);
    }

      public function property()
    {
        return $this->hasMany(Properties::class, 'pg_property_id','id');
    }

     public function reviews()
    {
        return $this->hasMany(Review::class, 'pg_property_id');
    }

}
