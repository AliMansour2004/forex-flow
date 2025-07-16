<?php

namespace App\Http\Requests\BrokersMembersBonuses;

use Illuminate\Foundation\Http\FormRequest;

class BrokersMembersBonusIndexRequest extends FormRequest
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
            'id.*' => 'nullable|exists:brokers_members_bonuses,id',
            'broker_id' => 'nullable|exists:users,id',
            'member_count' => 'nullable|integer',
            'bonus_per_member_per_month' => 'nullable|numeric',
            'entitlement_at' => 'nullable|date',
            'next_entitlement_at' => 'nullable|date',
            'entitlement_amount' => 'nullable|numeric',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
