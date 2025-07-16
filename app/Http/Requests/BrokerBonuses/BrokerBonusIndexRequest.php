<?php
namespace App\Http\Requests\BrokerBonuses;

use Illuminate\Foundation\Http\FormRequest;

class BrokerBonusIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
//        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'per_page' => 'nullable|integer|min:1',
            'id' => 'nullable|array',
            'id.*' => 'nullable|exists:broker_bonuses,id',
            'active_member_count' => 'nullable|integer',
            'bonus_per_member_per_month' => 'nullable|numeric',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
