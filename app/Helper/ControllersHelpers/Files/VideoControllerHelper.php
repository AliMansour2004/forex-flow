<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class VideoControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'title';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'title';

    public array $allowedSortKeys = [
        'title' => 'videos.title',
        'chapter_id' => 'videos.chapter_id',
        'user_id' => 'videos.user_id',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('chapter_id'))
            $model = $model->where('chapter_id', $request->chapter_id);

        if ($request->filled('user_id'))
            $model = $model->where('user_id', $request->user_id);

        if ($request->filled('title'))
            $model = $model->where('title', 'like', '%' . $request->title . '%');

        return parent::pagingSearchData($request, $model, $resource);
    }
}
