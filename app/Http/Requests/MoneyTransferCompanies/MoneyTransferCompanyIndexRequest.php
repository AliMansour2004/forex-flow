<?php

namespace App\Http\Requests\MoneyTransferCompanies;

use Illuminate\Foundation\Http\FormRequest;

class MoneyTransferCompanyIndexRequest extends FormRequest
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
            'id.*' => 'nullable|exists:money_transfer_companies,id',
            'name' => 'nullable|string',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
