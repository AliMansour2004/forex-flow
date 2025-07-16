<?php

namespace App\Http\Requests\BrokersReceipts;

use Illuminate\Foundation\Http\FormRequest;

class BrokersReceiptIndexRequest extends FormRequest
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
            'id.*' => 'nullable|exists:brokers_receipts,id',
            'our_company_money_account_id' => 'nullable|exists:our_company_money_accounts,id',
            'amount' => 'nullable|numeric',
            'receipt_at' => 'nullable|date',
            'transaction_id' => 'nullable|string',
            'added_by_user_id' => 'nullable|exists:users,id',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
