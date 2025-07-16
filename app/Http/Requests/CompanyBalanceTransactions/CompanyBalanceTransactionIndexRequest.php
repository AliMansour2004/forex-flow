<?php

namespace App\Http\Requests\CompanyBalanceTransactions;

use Illuminate\Foundation\Http\FormRequest;

class CompanyBalanceTransactionIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'per_page' => 'nullable|integer|min:1',
            'id' => 'nullable|array',
            'id.*' => 'nullable|exists:company_balance_transactions,id',
            'added_by_user_id' => 'nullable|exists:users,id',
            'our_company_money_account_id' => 'nullable|exists:our_company_money_accounts,id',
            'amount' => 'nullable|numeric',
            'reference_id' => 'nullable|string',
            'date' => 'nullable|date',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
