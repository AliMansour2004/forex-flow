<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class PaymentControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'amount';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'amount';

    public array $allowedSortKeys = [
        'amount' => 'payments.amount',
        'time' => 'payments.time',
        'purchased_at' => 'payments.purchased_at',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('amount')) {
            $model = $model->where('amount', $request->amount);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
