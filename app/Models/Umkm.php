<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $fillable = [
        'name',
        'category',
        'owner',
        'phone',
        'address',
        'description',
        'gmaps_embed',
        'product_photo',
        'agreement'
    ];
}
