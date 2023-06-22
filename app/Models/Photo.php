<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'latitude',
        'longitude',
        'year',
    ];
}
