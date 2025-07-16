<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\MoneyTransferCompanyControllerHelper;
use Illuminate\Routing\Controller;
use App\Http\Requests\MoneyTransferCompanies\MoneyTransferCompanyIndexRequest;
use App\Http\Requests\MoneyTransferCompanies\MoneyTransferCompanyStoreRequest;
use App\Http\Requests\MoneyTransferCompanies\MoneyTransferCompanyUpdateRequest;
use App\Http\Resources\MoneyTransferCompanyResource;
use App\Models\MoneyTransferCompany;

class MoneyTransferCompanyController extends Controller
{
    public function index(MoneyTransferCompanyIndexRequest $request)
    {
        return (new MoneyTransferCompanyControllerHelper)
            ->pagingSearchData($request, new MoneyTransferCompany(), MoneyTransferCompanyResource::class);
    }

    public function store(MoneyTransferCompanyStoreRequest $request)
    {
        $moneyTransferCompany = MoneyTransferCompany::create($request->validated());
        return new MoneyTransferCompanyResource($moneyTransferCompany);
    }

    public function show(MoneyTransferCompany $moneyTransferCompany)
    {
        return new MoneyTransferCompanyResource($moneyTransferCompany);
    }

    public function update(MoneyTransferCompanyUpdateRequest $request, MoneyTransferCompany $moneyTransferCompany)
    {
        $moneyTransferCompany->update($request->validated());
        return new MoneyTransferCompanyResource($moneyTransferCompany);
    }

    public function destroy($id)
    {
        if (!MoneyTransferCompany::findOrFail($id)->delete())
            abort(403);
    }
}
