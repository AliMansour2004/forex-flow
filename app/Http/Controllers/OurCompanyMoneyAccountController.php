<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\OurCompanyMoneyAccountControllerHelper;
use Illuminate\Routing\Controller;
use App\Http\Requests\OurCompanyMoneyAccounts\OurCompanyMoneyAccountIndexRequest;
use App\Http\Requests\OurCompanyMoneyAccounts\OurCompanyMoneyAccountStoreRequest;
use App\Http\Requests\OurCompanyMoneyAccounts\OurCompanyMoneyAccountUpdateRequest;
use App\Http\Resources\OurCompanyMoneyAccountResource;
use App\Models\OurCompanyMoneyAccount;
use Illuminate\Support\Facades\Auth;

class OurCompanyMoneyAccountController extends Controller
{
    public function index(OurCompanyMoneyAccountIndexRequest $request)
    {
        return (new OurCompanyMoneyAccountControllerHelper)
            ->pagingSearchData($request, new OurCompanyMoneyAccount(), OurCompanyMoneyAccountResource::class);
    }

    public function store(OurCompanyMoneyAccountStoreRequest $request)
    {
        $validated_request = $request->validated();
        $validated_request['added_by_user_id'] = Auth::id();
        $ourCompanyMoneyAccount = OurCompanyMoneyAccount::create($validated_request);
        return new OurCompanyMoneyAccountResource($ourCompanyMoneyAccount);
    }

    public function show(OurCompanyMoneyAccount $ourCompanyMoneyAccount)
    {
        return new OurCompanyMoneyAccountResource($ourCompanyMoneyAccount);
    }

    public function update(OurCompanyMoneyAccountUpdateRequest $request, OurCompanyMoneyAccount $ourCompanyMoneyAccount)
    {
        $validated_request = $request->validated();
        $validated_request['added_by_user_id'] = Auth::id();
        $ourCompanyMoneyAccount->update($validated_request);
        return new OurCompanyMoneyAccountResource($ourCompanyMoneyAccount);
    }

    public function destroy($id)
    {
        if (!OurCompanyMoneyAccount::findOrFail($id)->delete())
            abort(403);
    }
}
