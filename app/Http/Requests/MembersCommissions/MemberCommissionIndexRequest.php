<?php

namespace App\Http\Requests\MembersCommissions;

use Illuminate\Foundation\Http\FormRequest;

class MemberCommissionIndexRequest extends FormRequest
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
            'id.*' => 'nullable|exists:members_commissions,id',
            'user_id' => 'nullable|exists:users,id',
            'amount' => 'nullable|numeric',
            'date' => 'nullable|date',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
