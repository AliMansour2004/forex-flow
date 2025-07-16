<?php

namespace App\Http\Requests\CompanyBalanceTransactions;

use Illuminate\Foundation\Http\FormRequest;

class CompanyBalanceTransactionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'added_by_user_id' => 'sometimes|required|exists:users,id',
            'our_company_account_id' => 'sometimes|required|exists:our_company_money_accounts,id',
            'amount' => 'sometimes|required|numeric',
            'reference_id' => 'sometimes|string',
            'date' => 'sometimes|required|date',
            'description' => 'sometimes|string',
        ];
    }

    public function messages()
    {
        return [
            'added_by_user_id.required' => 'The added_by_user_id field is required.',
            'added_by_user_id.exists' => 'The selected added_by_user_id is invalid.',
            'our_company_account_id.required' => 'The our_company_money_account_id field is required.',
            'our_company_account_id.exists' => 'The selected our_company_money_account_id is invalid.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date must be a valid date.',
        ];
    }
}
