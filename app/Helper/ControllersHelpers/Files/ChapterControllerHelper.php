<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class ChapterControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'title';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'title';

    public array $allowedSortKeys = [
        'title' => 'chapters.title',
        'course_id' => 'chapters.course_id',
        'average_rating' => 'chapters.average_rating',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        $model = $model->with('videos.userFeedback');
        if ($request->filled('course_id'))
            $model->where('course_id', $request->course_id);

        if ($request->filled('title'))
            $model = $model->where('title', 'like', '%' . $request->title . '%');

        return parent::pagingSearchData($request, $model, $resource);
    }
}
