<?php

namespace App\Http\Requests\BrokersReceipts;

use Illuminate\Foundation\Http\FormRequest;

class BrokersReceiptStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'our_company_money_account_id' => 'required|exists:our_company_money_accounts,id',
            'amount' => 'required|numeric',
            'receipt_at' => 'required|date',
            'transaction_id' => 'required|string',
            'added_by_user_id' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'our_company_money_account_id.required' => 'The our_company_money_account_id field is required.',
            'our_company_money_account_id.exists' => 'The selected our_company_money_account_id is invalid.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'receipt_at.required' => 'The receipt_at field is required.',
            'receipt_at.date' => 'The receipt_at must be a valid date.',
            'transaction_id.required' => 'The transaction_id field is required.',
            'transaction_id.string' => 'The transaction_id must be a string.',
            'added_by_user_id.required' => 'The added_by_user_id field is required.',
            'added_by_user_id.exists' => 'The selected added_by_user_id is invalid.',
        ];
    }
}
