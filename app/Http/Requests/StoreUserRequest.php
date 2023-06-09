<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'required|string|max:250|min:3', // ['required', 'string', 'max:250', 'min:3'] is also valid
            'lastName' => 'required|string|max:250|min:3', // ['required', 'string', 'max:250', 'min:3'] is also valid
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8|max:255'
        ];
    }
}
