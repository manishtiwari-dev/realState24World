<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";

    public function property()
    {
        return $this->belongsTo(Properties::class, 'property_id');
    }

     public function dealer()
    {
        return $this->belongsTo(Dealer::class, 'dealer_id','id');
    }

    
}
