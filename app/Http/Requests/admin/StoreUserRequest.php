<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required | max:255',
            'email' => 'required | max:255 | email | unique:users,email',
            'user_catalogue_id' => 'required | integer | gt:0',
            'password' => 'required | min:6',
            'confirm_password' => 'required | min:6 | same:password',
        ];
    }
}
