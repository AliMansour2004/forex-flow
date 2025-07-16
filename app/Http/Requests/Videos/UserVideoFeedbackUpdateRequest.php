<?php

namespace App\Http\Requests\Videos;

use Illuminate\Foundation\Http\FormRequest;

class UserVideoFeedbackUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => 'nullable|integer|min:0|max:5',
            'feedback' => 'nullable|string',
            'last_progress' => 'nullable|date_format:H:i:s',
        ];
    }

    public function messages()
    {
        return [
            'rating.integer' => 'The rating must be an integer.',
            'rating.min' => 'The rating must be at least 0.',
            'rating.max' => 'The rating may not be greater than 5.',
            'feedback.string' => 'The feedback must be a string.',
            'last_progress.date_format' => 'The last progress must be in the format HH:MM:SS.',
        ];
    }
}
