<?php

namespace App\Http\Requests;

use App\Enums\PetStatuses;
use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'status' => ['required', 'in:'.implode(',', array_map(fn ($status) => $status->value, PetStatuses::cases()))],
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'photoUrls' => 'nullable|string',
        ];
    }
}
