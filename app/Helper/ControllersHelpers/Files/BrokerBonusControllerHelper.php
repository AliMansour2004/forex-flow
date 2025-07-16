<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class BrokerBonusControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'bonus_per_member_per_month';

    public string $defaultSortDirection = 'asc';

    public string $findColumn = 'bonus_per_member_per_month';

    public array $allowedSortKeys = [
        'bonus_per_member_per_month' => 'broker_bonuses.bonus_per_member_per_month',
        'active_member_count' => 'broker_bonuses.active_member_count',
        'created_at' => 'broker_bonuses.created_at',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('bonus_per_member_per_month')) {
            $model = $model->where('bonus_per_member_per_month', $request->bonus_per_member_per_month);
        }

        if ($request->filled('active_member_count')) {
            $model = $model->where('active_member_count', $request->active_member_count);
        }

        if ($request->filled('user_id')) {
            $model = $model->where('user_id', $request->user_id);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
