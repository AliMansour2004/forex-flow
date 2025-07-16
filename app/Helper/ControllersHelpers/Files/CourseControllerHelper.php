<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class CourseControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'name';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'name';

    public array $allowedSortKeys = [
        'name' => 'courses.name',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('name'))
            $model = $model->where('name', 'like', '%' . $request->name . '%');

        return parent::pagingSearchData($request, $model, $resource);
    }
}
