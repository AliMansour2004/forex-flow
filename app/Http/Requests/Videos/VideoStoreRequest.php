<?php

namespace App\Http\Requests\Videos;

use Illuminate\Foundation\Http\FormRequest;

class VideoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'chapter_id' => 'required|exists:chapters,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:0',
            'video_url' => 'required|url',
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
            'duration.required' => 'The duration field is required.',
            'duration.integer' => 'The duration must be an integer.',
            'duration.min' => 'The duration must be at least 0.',
            'video_url.required' => 'The video_url field is required.',
            'video_url.url' => 'The video URL must be a valid URL.',
        ];
    }
}

