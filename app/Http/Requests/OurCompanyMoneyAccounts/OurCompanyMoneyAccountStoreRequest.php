<?php

namespace App\Http\Requests\OurCompanyMoneyAccounts;

use Illuminate\Foundation\Http\FormRequest;

class OurCompanyMoneyAccountStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'money_transfer_company_id' => 'required|exists:money_transfer_companies,id',
            'name' => 'required|string',
            'phone_number' => 'required|numeric',
        ];
    }
}
