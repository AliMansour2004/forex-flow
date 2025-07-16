<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\CompanyBalanceTransactionControllerHelper;
use Illuminate\Routing\Controller;
use App\Http\Requests\CompanyBalanceTransactions\CompanyBalanceTransactionIndexRequest;
use App\Http\Requests\CompanyBalanceTransactions\CompanyBalanceTransactionStoreRequest;
use App\Http\Requests\CompanyBalanceTransactions\CompanyBalanceTransactionUpdateRequest;
use App\Http\Resources\CompanyBalanceTransactionResource;
use App\Models\CompanyBalanceTransaction;
use Illuminate\Support\Facades\Auth;

class CompanyBalanceTransactionController extends Controller
{
    public function index(CompanyBalanceTransactionIndexRequest $request)
    {
        return (new CompanyBalanceTransactionControllerHelper)
            ->pagingSearchData($request, new CompanyBalanceTransaction(), CompanyBalanceTransactionResource::class);
    }

    public function store(CompanyBalanceTransactionStoreRequest $request)
    {
        $validated_request = $request->validated();
        $validated_request['added_by_user_id'] = Auth::id();
        $companyBalanceTransaction = CompanyBalanceTransaction::create($validated_request);
        return new CompanyBalanceTransactionResource($companyBalanceTransaction);
    }

    public function show(CompanyBalanceTransaction $companyBalanceTransaction)
    {
        return new CompanyBalanceTransactionResource($companyBalanceTransaction);
    }

    public function update(CompanyBalanceTransactionUpdateRequest $request, CompanyBalanceTransaction $companyBalanceTransaction)
    {
        $validated_request = $request->validated();
        $validated_request['added_by_user_id'] = Auth::id();
        $companyBalanceTransaction->update($validated_request);
        return new CompanyBalanceTransactionResource($companyBalanceTransaction);
    }

//    public function destroy($id)
//    {
//        if (!CompanyBalanceTransaction::findOrFail($id)->delete())
//            abort(403);
//    }
}
