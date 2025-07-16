<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\BrokerBonusControllerHelper;
use Illuminate\Routing\Controller;
use App\Http\Requests\BrokerBonuses\BrokerBonusIndexRequest;
use App\Http\Requests\BrokerBonuses\BrokerBonusStoreRequest;
use App\Http\Requests\BrokerBonuses\BrokerBonusUpdateRequest;
use App\Http\Resources\BrokerBonusResource;
use App\Models\BrokerBonus;

class BrokerBonusController extends Controller
{
    public function index(BrokerBonusIndexRequest $request)
    {
        return (new BrokerBonusControllerHelper)
            ->pagingSearchData($request, new BrokerBonus(), BrokerBonusResource::class);
    }

//    public function store(BrokerBonusStoreRequest $request)
//    {
//        $brokerBonus = BrokerBonus::create($request->validated());
//        return new BrokerBonusResource($brokerBonus);
//    }

//    public function show(BrokerBonus $brokerBonus)
//    {
//        return new BrokerBonusResource($brokerBonus);
//    }

//    public function update(BrokerBonusUpdateRequest $request, BrokerBonus $brokerBonus)
//    {
//        $brokerBonus->update($request->all());
//        return new BrokerBonusResource($brokerBonus);
//    }

//    public function destroy($id)
//    {
//        if (!BrokerBonus::findOrFail($id)->delete())
//            abort(403);
//    }
}
