<?php

namespace App\Http\Requests\Members;

use Illuminate\Foundation\Http\FormRequest;

class MemberIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();

        return ($user->hasRole('admin') || $user->hasRole('broker'));
    }

    public function rules(): array
    {
        return [
            'per_page' => 'nullable|integer|min:1',
            'id' => 'nullable|array',
            'id.*' => 'nullable|exists:members,id',
            'user_id' => 'nullable|exists:users,id',
            'finished_at' => 'nullable|date',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
