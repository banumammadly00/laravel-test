<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;


    protected $fillable = [
        'title','lead','body','image', 'user_id', 'status', 'user_name','created', 'updated'
    ];

    protected $casts = [
        'created' => 'datetime:Y-m-d  H:i',
        'updated' => 'datetime:Y-m-d  H:i'
    ];
}
