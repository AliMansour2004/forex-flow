<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class BrokersMembersBonusControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'entitlement_at';
    public string $defaultSortDirection = 'asc';
    public string $findColumn = 'member_count';
    public array $allowedSortKeys = [
        'broker_id' => 'brokers_members_bonuses.broker_id',
        'member_count' => 'brokers_members_bonuses.member_count',
        'bonus_per_member_per_month' => 'brokers_members_bonuses.bonus_per_member_per_month',
        'entitlement_at' => 'brokers_members_bonuses.entitlement_at',
        'next_entitlement_at' => 'brokers_members_bonuses.next_entitlement_at',
        'entitlement_amount' => 'brokers_members_bonuses.entitlement_amount',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('broker_id')) {
            $model = $model->where('broker_id', $request->broker_id);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
