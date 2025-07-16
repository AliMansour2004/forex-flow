<?php
namespace App\Http\Requests\Chapters;

use Illuminate\Foundation\Http\FormRequest;

class ChapterIndexRequest extends FormRequest
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
            'id.*' => 'nullable|exists:chapters,id',
            'course_id' => 'nullable|exists:courses,id',
            'title' => 'nullable|string',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
