<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateEducationRequest extends FormRequest
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
            'education' => 'required|string|max:255',
//            'id' => 'required|string'

        ];
    }
    public function messages(): array
    {
        return [
            'education.required' => 'The education field is required.',
            'education.string' => 'The education field must be a string.',
            'education.max' => 'The education field must not exceed 255 characters.',
        ];
    }
    public function getEducation()
    {
        return request()->input('education');

    }
    public function getId(): ?int
    {
        return request()->input('id');
    }
}
