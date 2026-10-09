<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    //

      public function property()
    {
        return $this->hasMany(Properties::class, 'dealer_id','id');
    }

     public function reviews()
    {
        return $this->hasMany(Review::class, 'dealer_id');
    }
    
    
}
