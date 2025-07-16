<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class CardControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'amount';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'amount';

    public array $allowedSortKeys = [
        'amount' => 'cards.amount',
        'duration' => 'cards.duration',
        'discount' => 'cards.discount',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('amount')) {
            $model = $model->where('amount', $request->amount);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
