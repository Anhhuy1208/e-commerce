<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rateblog extends Model
{
    //
    protected $fillable = [
        'rate',
        'id_blog',
        'id_user',

    ];
}
