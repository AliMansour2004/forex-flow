<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class CompanyBalanceTransactionControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'date';
    public string $defaultSortDirection = 'asc';
    public string $findColumn = 'amount';
    public array $allowedSortKeys = [
        'added_by_user_id' => 'company_balance_transactions.added_by_user_id',
        'our_company_money_account_id' => 'company_balance_transactions.our_company_money_account_id',
        'amount' => 'company_balance_transactions.amount',
        'reference_id' => 'company_balance_transactions.reference_id',
        'date' => 'company_balance_transactions.date',
        'description' => 'company_balance_transactions.description',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('added_by_user_id')) {
            $model = $model->where('added_by_user_id', $request->added_by_user_id);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
