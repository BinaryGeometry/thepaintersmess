<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Regiment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RegimentFactory extends Factory
{
    protected $model = Regiment::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'meta' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'parent_id' => Regiment::factory(),
            'game_id' => Item::factory(),
            'faction_id' => Item::factory(),
            'detachment_id' => Item::factory(),
            'unit_id' => Item::factory(),
            'user_id' => User::factory(),
        ];
    }
}
