<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Products';

    protected $fillable = ['name', 'unity', 'price', 'icon_url'];

    public $timestamps = false;
}
