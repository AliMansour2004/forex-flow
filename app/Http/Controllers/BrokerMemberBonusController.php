<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\BrokersMembersBonusControllerHelper;
use Illuminate\Routing\Controller;
use App\Http\Requests\BrokersMembersBonuses\BrokersMembersBonusIndexRequest;
use App\Http\Requests\BrokersMembersBonuses\BrokersMembersBonusStoreRequest;
use App\Http\Requests\BrokersMembersBonuses\BrokersMembersBonusUpdateRequest;
use App\Http\Resources\BrokersMembersBonusResource;
use App\Models\BrokerMemberBonus;

class BrokerMemberBonusController extends Controller
{
    public function index(BrokersMembersBonusIndexRequest $request)
    {
        return (new BrokersMembersBonusControllerHelper)
            ->pagingSearchData($request, new BrokerMemberBonus(), BrokersMembersBonusResource::class);
    }

    public function store(BrokersMembersBonusStoreRequest $request)
    {
        $brokersMembersBonus = BrokerMemberBonus::create($request->validated());
        return new BrokersMembersBonusResource($brokersMembersBonus);
    }

    public function show(BrokerMemberBonus $brokersMembersBonus)
    {
        return new BrokersMembersBonusResource($brokersMembersBonus);
    }
//todo:check if there any way to update

//    public function update(BrokersMembersBonusUpdateRequest $request, BrokerMemberBonus $brokersMembersBonus)
//    {
//        $brokersMembersBonus->update($request->all());
//        return new BrokersMembersBonusResource($brokersMembersBonus);
//    }

//    public function destroy($id)
//    {
//        if (!BrokerMemberBonus::findOrFail($id)->delete())
//            abort(403);
//    }
}
