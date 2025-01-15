<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegimentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable'],
            'slug' => ['nullable'],
            'parent_id' => ['nullable', 'exists:regiments'],
            'game_id' => ['nullable', 'exists:items'],
            'faction_id' => ['nullable', 'exists:items'],
            'detachment_id' => ['nullable', 'exists:items'],
            'unit_id' => ['nullable', 'exists:items'],
            'meta' => ['nullable'],
            'user_id' => ['nullable', 'exists:users'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
