<?php

namespace App\Http\Requests\BrokersMembersBonuses;

use Illuminate\Foundation\Http\FormRequest;

class BrokersMembersBonusStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'broker_id' => 'required|exists:brokers,id',
            'member_count' => 'required|integer',
            'bonus_per_member_per_month' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'broker_id.required' => 'The broker_id field is required.',
            'broker_id.exists' => 'The selected broker_id is invalid.',
            'member_count.required' => 'The member_count field is required.',
            'member_count.integer' => 'The member_count must be an integer.',
            'bonus_per_member_per_month.required' => 'The bonus_per_member_per_month field is required.',
            'bonus_per_member_per_month.numeric' => 'The bonus_per_member_per_month must be a number.',
        ];
    }
}
