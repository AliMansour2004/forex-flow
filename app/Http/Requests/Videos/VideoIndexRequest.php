<?php
namespace App\Http\Requests\Videos;

use Illuminate\Foundation\Http\FormRequest;

class VideoIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'per_page' => 'nullable|integer|min:1',
            'id' => 'nullable|array',
            'id.*' => 'nullable|exists:videos,id',
            'chapter_id' => 'nullable|exists:chapters,id',
            'title' => 'nullable|string',
            'duration' => 'nullable|integer|min:0',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}

