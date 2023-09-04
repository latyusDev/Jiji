<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'string', 'email' , Rule::unique('users', 'email')],
            'state' => 'required',
            'password' => 'required|confirmed|min:6',
            'country' => 'required',
            'state' => 'required',
            'local_government' => 'required',
            'street' => 'required',
        ];
    }
}
