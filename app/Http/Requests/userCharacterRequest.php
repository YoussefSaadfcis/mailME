<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userCharacterRequest extends FormRequest
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
            'mood' => 'string|nullable|max:255',
            'motivation'=> 'string|nullable|max:255',
            'tone' => 'string|nullable|max:255',
            'religion' => 'string|nullable|max:255',
            'allow_religion_use' => 'boolean|nullable|max:255',
            'about' => 'string|nullable|max:255',
        ];
    }
}
