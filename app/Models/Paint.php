<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paint extends Model
{
    //
    protected $fillable = [
        'brand',
        'range',
        'paint_name',
        'paint_ref',
        'color_name',
        'color_hex',
        'paint_type',
        'thumbnail',
        'available',
    ];

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);

    }
}
