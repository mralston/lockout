<?php

namespace Mralston\Lockout\Models;

use Illuminate\Database\Eloquent\Model;

class AuthFailure extends Model
{
    public $fillable = [
        'user_id',
        'email',
        'attempts',
    ];
}
