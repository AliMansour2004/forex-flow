<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'type';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'type';

    public array $allowedSortKeys = [
        'type' => 'expenses_types.type',
        'cost' => 'expenses.cost',
        'expensed_date' => 'expenses.expensed_at',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('type_id'))
            $model = $model->whereIn('type_id', $request->type_id);

        if ($request->has('start_date') && $request->has('end_date')) {
            $model = $model->whereBetween('expenses.expensed_at', [$request->start_date, $request->end_date]);
        }

        $model = $model->join('expenses_types', 'expenses.type_id', '=', 'expenses_types.id');

        return parent::pagingSearchData($request, $model, $resource);
    }
}
