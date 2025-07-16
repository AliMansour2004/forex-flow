<?php

namespace App\Http\Requests\MemberSubscriptions;

use Illuminate\Foundation\Http\FormRequest;

class MemberSubscriptionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id|unique:members_subscriptions,user_id,' . $this->member_subscription->id,
            'finished_at' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'The user ID field is required.',
            'user_id.exists' => 'The selected user ID is invalid.',
            'user_id.unique' => 'The user ID has already been taken.',
            'finished_at.date' => 'The finished at must be a valid date.',
        ];
    }
}
