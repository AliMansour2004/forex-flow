<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class MemberCommissionControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'date';
    public string $defaultSortDirection = 'asc';
    public string $findColumn = 'amount';
    public array $allowedSortKeys = [
        'user_id' => 'members_commissions.user_id',
        'amount' => 'members_commissions.amount',
        'date' => 'members_commissions.date',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('user_id')) {
            $model = $model->where('user_id', $request->user_id);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
