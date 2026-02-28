<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class commentblog extends Model
{
    //
    protected $fillable = [
          'comment',
          'id_blog',
          'id_user',
          'avatar_user',
          'name_user',
    ];
}
