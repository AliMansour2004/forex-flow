<?php

namespace App\Http\Requests\CardsPayments;

use Illuminate\Foundation\Http\FormRequest;

class CardPaymentIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();
//        return true;
//        return auth()->user()?->hasRole('admin');
        return ($user->hasRole('admin') || $user->hasRole('broker'));
    }

    public function rules(): array
    {
        return [
            'per_page' => 'nullable|integer|min:1',
            'id' => 'nullable|array',
            'id.*' => 'nullable|exists:payments,id',
            'amount' => 'nullable|numeric',
//            'duration' => 'nullable|integer',
            'discount' => 'nullable|numeric',
//            'cost' => 'nullable|numeric',
//            'fees' => 'nullable|numeric',
//            'gross_profit' => 'The gross_profit field is required.',
            'purchased_at' => 'nullable|date',
            'broker_id' => 'nullable|exists:users,id',
            'broker_profit_percentage' => 'nullable|numeric',
            'broker_profit_cost' => 'nullable|numeric',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
