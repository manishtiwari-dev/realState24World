<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCode extends Model
{
    use HasFactory;
    public $table = "user_codes";

    protected $fillable = [
        'user_id',
        'verification_request',
        'verification_type',
        'code',
        'status',
        'expire_at',
    ];
}
