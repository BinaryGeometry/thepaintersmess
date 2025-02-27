<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $fillable = [
        'unit_id',
        'detachment_id',
        'faction_id',
        'regiment_id',
        'game_id',
        'meta',
        'slug',
        'user_id',
        'thumbnail',
        'name',
    ];
}
