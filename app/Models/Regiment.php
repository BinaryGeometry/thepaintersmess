<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regiment extends Model
{
    use HasFactory, SoftDeletes;

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Regiment::class, 'parent_id');
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'game_id');
    }

    public function faction(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'faction_id');
    }

    public function detachment(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'detachment_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'unit_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'meta' => 'array',
        ];
    }
}
