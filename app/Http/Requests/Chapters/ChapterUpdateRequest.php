<?php

namespace App\Http\Requests\Chapters;

use Illuminate\Foundation\Http\FormRequest;

class ChapterUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'course_id' => 'sometimes|required|exists:courses,id',
            'title' => 'sometimes|required|string',
            'sub_title' => 'sometimes|string',
            'description' => 'nullable|string',
            'image_url' => 'sometimes|url',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => 'The course ID field is required.',
            'course_id.exists' => 'The selected course ID is invalid.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'sub_title.required' => 'The sub_title field is required.',
            'sub_title.string' => 'The tag must be a string.',
            'description.string' => 'The description must be a string.',
            'estimated_time.integer' => 'The estimated time must be an integer.',
            'estimated_time.min' => 'The estimated time must be at least 0.',
            'image_url.required' => 'The image_url field is required.',
            'image_url.url' => 'The image_url must be a valid URL.',
        ];
    }
}
