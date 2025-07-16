<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class MoneyTransferCompanyControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'name';
    public string $defaultSortDirection = 'asc';
    public string $findColumn = 'name';
    public array $allowedSortKeys = [
        'name' => 'money_transfer_companies.name',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('name')) {
            $model = $model->where('name', $request->name);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
