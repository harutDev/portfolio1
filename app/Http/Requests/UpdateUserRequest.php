<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->id,
            'age' => 'required|integer|min:0|max:120',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'languages' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'surname.required' => 'Surname is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email has already been taken.',
            'age.required' => 'Age is required.',
            'age.integer' => 'Age must be an integer.',
            'age.min' => 'Age must be at least 0.',
            'age.max' => 'Age may not be greater than 120.',
            'address.required' => 'Address is required.',
            'phone.required' => 'Phone is required.',
            'languages.required' => 'Languages are required.',
        ];
    }

    public function getName ():string
    {
        return request()->input('name');

    }
    public function getSurname ():string
    {
        return request()->input('surname');

    }
        public function getEmail ():string
    {
        return request()->input('email');

    }

    public function getPhone ():string
    {
        return request()->input('phone');

    }
    public function getAge ():int
    {
        return request()->input('age');

    }
    public function getAddress ():string
    {
        return request()->input('address');

    }
    public function getLanguages (): array
    {
        return request()->input('languages');

    }
    public function getId(): ?int
    {
        return request()->input('id');
    }

}
