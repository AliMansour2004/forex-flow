<?php

namespace App\Http\Requests\Videos;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'chapter_id' => 'sometimes|required|exists:chapters,id',
            'title' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'duration' => 'sometimes|integer|min:0',
            'video_url' => 'sometimes|url',
        ];
    }

    public function messages()
    {
        return [
            'chapter_id.required' => 'The chapter ID field is required.',
            'chapter_id.exists' => 'The selected chapter ID is invalid.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'description.string' => 'The description must be a string.',
            'duration.integer' => 'The duration must be an integer.',
            'duration.min' => 'The duration must be at least 0.',
            'video_url.required' => 'The video_url field is required.',
            'video_url.url' => 'The video URL must be a valid URL.',
        ];
    }
}
