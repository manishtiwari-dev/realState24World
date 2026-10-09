<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnPolicy extends Model
{
    protected $table = "return_policy";
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public $timestamps = false;



}

