<?php

namespace App\Helper\ControllersHelpers\Files;

use App\Helper\ControllersHelpers\ControllerHelper;
use Illuminate\Foundation\Http\FormRequest;

class BrokersReceiptControllerHelper extends ControllerHelper
{
    public string $defaultSortKey = 'receipt_at';
    public string $defaultSortDirection = 'asc';
    public string $findColumn = 'amount';
    public array $allowedSortKeys = [
        'our_company_money_account_id' => 'brokers_receipts.our_company_money_account_id',
        'amount' => 'brokers_receipts.amount',
        'receipt_at' => 'brokers_receipts.receipt_at',
        'transaction_id' => 'brokers_receipts.transaction_id',
        'added_by_user_id' => 'brokers_receipts.added_by_user_id',
    ];

    public function pagingSearchData(FormRequest $request, $model, $resource): array
    {
        if ($request->filled('our_company_money_account_id')) {
            $model = $model->where('our_company_money_account_id', $request->our_company_money_account_id);
        }

        return parent::pagingSearchData($request, $model, $resource);
    }
}
