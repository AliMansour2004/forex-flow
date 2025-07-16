<?php

namespace App\Http\Requests\Members;

use Illuminate\Foundation\Http\FormRequest;

class MemberUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id|unique:members,user_id,' . $this->member->id,
            'finished_at' => 'sometimes|nullable|date',
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
