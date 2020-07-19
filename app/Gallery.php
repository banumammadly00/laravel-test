<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'gallery';

    protected $fillable = [
        'image','user_id','created'
    ];

    protected $casts = [
        'created' => 'datetime:Y-m-d',
    ];
}
