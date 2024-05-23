<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateAboutMeRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'about_me' => 'required|string|max:1000',
            'id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'about_me.required' => 'The About Me section cannot be empty.',
            'about_me.string' => 'The About Me section must be a string.',
            'about_me.max' => 'The About Me section may not be greater than 1000 characters.',
        ];
    }
    public function getAboutMe(): string
    {
        return request()->input('about_me');
    }

    public function getId(): ?int
    {
        return request()->input('id');
    }

}
