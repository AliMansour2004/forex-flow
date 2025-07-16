<?php

namespace App\Http\Requests\MoneyTransferCompanies;

use Illuminate\Foundation\Http\FormRequest;

class MoneyTransferCompanyUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string',
        ];
    }
}
