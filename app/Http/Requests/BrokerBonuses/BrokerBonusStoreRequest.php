<?php

namespace App\Http\Requests\BrokerBonuses;

use Illuminate\Foundation\Http\FormRequest;

class BrokerBonusStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'active_member_count' => 'required|integer',
            'bonus_per_member_per_month' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'active_member_count.required' => 'The active member count field is required.',
            'active_member_count.integer' => 'The active member count must be an integer.',
            'bonus_per_member_per_month.required' => 'The bonus per member per month field is required.',
            'bonus_per_member_per_month.numeric' => 'The bonus per member per month must be a number.',
        ];
    }
}
