<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateResearcherRequest extends FormRequest
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
        $researcherId = $this->route("id");

        return [
            "name" => ["sometimes", "string", "max:255"],
            "email" => ["sometimes", "email", "unique:researchers,email," . $researcherId],
        ];
    }
}
