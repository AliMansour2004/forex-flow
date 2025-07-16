<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('users', 'id'),
            ],
            'first_name' => [
                'required',
                'string',
            ],
            'middle_name' => [
                'required',
                'string',
            ],
            'last_name' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('users')->ignore($this->user)->where(function ($query) {
                    return $query->where('first_name', $this->first_name)
                        ->where('middle_name', $this->middle_name)
                        ->where('last_name', $this->last_name)
                        ->where('email', $this->email);
                }),
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($this->user),
            ],
            'user_name' => [
                'required',
                'string',
                Rule::unique('users', 'user_name')->ignore($this->user),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#_])[A-Za-z\d@$!%*?&#_]{8,}$/',
                'confirmed',
            ],
            'balance' => 'nullable|numeric',
            'is_active' => 'nullable|boolean',
            'is_our_broker_account_open' => 'nullable|boolean',
            'our_broker_server_name' => 'nullable|string',
            'our_broker_account_number' => [
                'nullable',
                'integer',
                Rule::unique('users', 'our_broker_account_number')->ignore($this->user),
            ],
            'role' => [
                'required',
                Rule::in(['member', 'instructor']),
            ],

            // card_payments table parameters
            'duration' => 'nullable|numeric',
            //
        ];
    }

    public function messages()
    {
        return [
            'parent_id.integer' => 'The parent ID must be a valid integer.',
            'parent_id.exists' => 'The parent ID must reference an existing user.',
            'first_name.required' => 'The first name field is required.',
            'first_name.string' => 'The first name must be a string.',
            'middle_name.required' => 'The middle name field is required.',
            'middle_name.string' => 'The middle name must be a string.',
            'last_name.required' => 'The last name field is required.',
            'last_name.string' => 'The last name must be a string.',
            'phone.required' => 'The phone number field is required.',
            'phone.string' => 'The phone number must be a string.',
            'phone.unique' => 'The combination of first name, middle name, last name, phone, and email must be unique.',
            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a string.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'user_name.required' => 'The user name field is required.',
            'user_name.string' => 'The user name must be a string.',
            'user_name.unique' => 'The user name has already been taken.',
            'password.string' => 'The password must be a string.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character (@, $, !, %, *, ?, &, #, _).',
            'balance.numeric' => 'The balance must be a number.',
            'is_active.boolean' => 'The is active field must be true or false.',
            'is_our_broker_account_open.boolean' => 'The is our broker account open field must be true or false.',
            'our_broker_server_name.string' => 'The broker server name must be a string.',
            'our_broker_account_number.integer' => 'The broker account number must be an integer.',
            'our_broker_account_number.unique' => 'The broker account number has already been taken.',
            'role.required' => 'The role field is required.',
            'role.in' => 'The role must be one of the following: broker, member, instructor.',
        ];
    }
}
