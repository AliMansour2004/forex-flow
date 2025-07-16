<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class OurCompanyMoneyAccountControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'name';
    public string $defaultSortDirection = 'asc';
    public string $findColumn = 'name';
    public array $allowedSortKeys = [
        'money_transfer_company_id' => 'our_company_money_accounts.money_transfer_company_id',
        'name' => 'our_company_money_accounts.name',
        'phone_number' => 'our_company_money_accounts.phone_number',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('money_transfer_company_id')) {
            $model = $model->where('money_transfer_company_id', $request->money_transfer_company_id);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
