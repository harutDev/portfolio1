<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest
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
            'name' => 'required|string|max:255',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The education name is required.',
            'name.string' => 'The education name must be a string.',
            'name.max' => 'The education name may not be greater than 255 characters.',
        ];
    }
    public function getName()
    {
        return request()->input('name');

    }
    public function getId(): ?int
    {
        return request()->input('id');
    }

}
