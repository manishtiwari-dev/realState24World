<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermCondition extends Model
{
    protected $table = "term_conditions";
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public $timestamps = false;


}

