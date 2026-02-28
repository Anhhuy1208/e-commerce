<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


     protected $fillable =[
     'name',
     'id_user',
     'price',
     'id_category',
     'id_brand',
     'status',
     'sale',
     'company',
     'hinhanh',
     'detail',
     ];
}
