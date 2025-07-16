<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\BrokersReceiptControllerHelper;
use Illuminate\Routing\Controller;
use App\Http\Requests\BrokersReceipts\BrokersReceiptIndexRequest;
use App\Http\Requests\BrokersReceipts\BrokersReceiptStoreRequest;
use App\Http\Requests\BrokersReceipts\BrokersReceiptUpdateRequest;
use App\Http\Resources\BrokersReceiptResource;
use App\Models\BrokerReceipt;
use Illuminate\Support\Facades\Auth;

class BrokerReceiptController extends Controller
{
    public function index(BrokersReceiptIndexRequest $request)
    {
        return (new BrokersReceiptControllerHelper)
            ->pagingSearchData($request, new BrokerReceipt(), BrokersReceiptResource::class);
    }

    public function store(BrokersReceiptStoreRequest $request)
    {
//        $brokersReceipt = BrokerReceipt::create($request->all());
//        return new BrokersReceiptResource($brokersReceipt);
        $validated_request = $request->validated();
        $validated_request['added_by_user_id'] = Auth::id();
        $broker_receipt = BrokerReceipt::create($validated_request);
        return new BrokersReceiptResource($broker_receipt);
    }

    public function show(BrokerReceipt $brokersReceipt)
    {
        return new BrokersReceiptResource($brokersReceipt);
    }

    public function update(BrokersReceiptUpdateRequest $request, BrokerReceipt $brokersReceipt)
    {
        $validated_request = $request->validated();
        $validated_request['added_by_user_id'] = Auth::id();
        $brokersReceipt->update($validated_request);
        return new BrokersReceiptResource($brokersReceipt);
    }

//    public function destroy($id)
//    {
//        if (!BrokerReceipt::findOrFail($id)->delete())
//            abort(403);
//    }
}
