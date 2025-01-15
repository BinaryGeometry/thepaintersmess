<?php

namespace App\Http\Resources;

use App\Models\Regiment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Regiment */
class RegimentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'meta' => $this->meta,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'parent_id' => $this->parent_id,
            'game_id' => $this->game_id,
            'faction_id' => $this->faction_id,
            'detachment_id' => $this->detachment_id,
            'unit_id' => $this->unit_id,
            'user_id' => $this->user_id,

            'parent' => new RegimentResource($this->whenLoaded('parent')),
        ];
    }
}
