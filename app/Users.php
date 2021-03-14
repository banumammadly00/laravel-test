<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'email','pass', 'name', 'mobile', 'role', 'birthday', 'about','image'
    ];

    protected $casts = [
        'birthday' => 'datetime:Y-m-d',
    ];
}
