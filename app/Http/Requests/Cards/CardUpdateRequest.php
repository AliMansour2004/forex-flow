<?php

namespace App\Http\Requests\Cards;

use Illuminate\Foundation\Http\FormRequest;

class CardUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'amount' => 'sometimes|required|numeric',
            'duration' => 'sometimes|required|integer',
            'discount' => 'sometimes|required|numeric',
            'broker_percentage' => 'sometimes|required|numeric',
            'broker_profit_cost' => 'sometimes|required|numeric',
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
            'broker_percentage.required' => 'The broker percentage field is required.',
            'broker_percentage.numeric' => 'The broker percentage must be a number.',
            'broker_profit_cost.required' => 'The broker profit cost field is required.',
            'broker_profit_cost.numeric' => 'The broker profit cost must be a number.',
        ];
    }
}
