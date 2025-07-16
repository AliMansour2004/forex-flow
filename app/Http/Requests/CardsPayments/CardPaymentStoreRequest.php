<?php

namespace App\Http\Requests\CardsPayments;

use Illuminate\Foundation\Http\FormRequest;

class CardPaymentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric',
            'duration' => 'required|integer',
            'discount' => 'nullable|numeric',
            'user_id' => 'required|exists:users,id',
            'broker_id' => 'nullable|exists:users,id',
            'our_company_money_account_id' => 'nullable|exists:our_company_money_accounts,id',
            'transaction_id' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'duration.required' => 'The duration field is required.',
            'duration.integer' => 'The duration must be an integer.',
            'discount.required' => 'The discount field is required.',
            'discount.numeric' => 'The discount must be a number.',
            'broker_id.exists' => 'The selected broker ID is invalid.',
            'user_id.required' => 'The user_id field is required',
            'user_id.exists' => 'The selected user ID is invalid.',
            'our_company_money_account_id.exists' => 'The selected company money account does not exist.',
            'transaction_id.string' => 'The transaction ID must be a string.'
        ];
    }
}
