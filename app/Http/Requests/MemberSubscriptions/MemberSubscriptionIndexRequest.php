<?php

namespace App\Http\Requests\MemberSubscriptions;

use Illuminate\Foundation\Http\FormRequest;

class MemberSubscriptionIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
//        $user = auth()->user();
//        return true;
        return auth()->user()?->hasRole('admin');
//        return ($user->hasRole('admin') || $user->hasRole('broker'));
    }

    public function rules(): array
    {
        return [
            'per_page' => 'nullable|integer|min:1',
            'id' => 'nullable|array',
            'id.*' => 'nullable|exists:members_subscriptions,id',
            'user_id' => 'nullable|exists:users,id',
            'finished_at' => 'nullable|date',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
