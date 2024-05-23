<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateLinkRequest extends FormRequest
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
            'post_id' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'post_id.required' => 'The post ID field is required.',
        ];
    }
    public function getName():string
    {
        return request()->input('name');

    }
    public function getPostId(): ?int
    {
        return request()->input('post_id');
    }
    public function getId(): ?int
    {
        return request()->input('id');
    }

}
