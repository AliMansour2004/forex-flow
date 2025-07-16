<?php

namespace App\Http\Requests\OurCompanyMoneyAccounts;

use Illuminate\Foundation\Http\FormRequest;

class OurCompanyMoneyAccountIndexRequest extends FormRequest
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
            'id.*' => 'nullable|exists:our_company_money_accounts,id',
            'money_transfer_company_id' => 'nullable|exists:money_transfer_companies,id',
            'name' => 'nullable|string',
            'phone_number' => 'nullable|numeric',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
