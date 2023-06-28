<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'direction_deg_from_north',
        'latitude',
        'longitude',
        'year',
    ];
}
