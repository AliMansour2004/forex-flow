<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\PaymentControllerHelper;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use App\Http\Requests\CardsPayments\CardPaymentIndexRequest;
use App\Http\Requests\CardsPayments\CardPaymentStoreRequest;
use App\Http\Resources\CardPaymentResource;
use App\Models\CardPayment;
use Illuminate\Support\Facades\Auth;

class CardPaymentController extends Controller
{
    public function index(CardPaymentIndexRequest $request)
    {
        $authUser = Auth::user();

        $query = CardPayment::with('user'); // 👈 eager-load the user

        if ($authUser->hasRole('broker')) {
            $query->where(function ($q) use ($authUser) {
                $q->where('broker_id', $authUser->id);
//                    ->orWhere('user_id', $authUser->id);
            });
        } else {
            $query->where('user_id', $authUser->id);
        }

        return (new PaymentControllerHelper)->pagingSearchData($request, $query, CardPaymentResource::class);
    }


    public function store(CardPaymentStoreRequest $request)
    {
        $validated_request = $request->validated();

        $existingPayment = CardPayment::where('user_id', $validated_request['user_id'])->orderBy('created_at', 'desc')->first();

        $duration = (int)$validated_request['duration'];
        $validated_request['fees'] = 0;
        $validated_request['purchased_at'] = now();
        $validated_request['finished_at'] = now()->addMonths($duration)->addDay();
        $validated_request['added_by_user_id'] = Auth::id();
        $amount = $validated_request['amount'];

        if (!empty($validated_request['discount'])) {
            $amount -= $amount * $validated_request['discount'] / 100;
        }


        if (!empty($validated_request['our_company_money_account_id'])) {
            $accountFees = [
                1 => 0.3,
                2 => 2
            ];
            $fees = $accountFees[$validated_request['our_company_money_account_id']] ?? null;
            $validated_request['fees'] = $fees;
        }

        if ($existingPayment) {

            $new_finished_at = $existingPayment->finished_at <= now()
                ? now()->addMonths($duration)
                : $existingPayment->finished_at->copy()->addMonths($duration);

            $validated_request['finished_at'] = $new_finished_at->addDay();

            if (!empty($existingPayment->broker_id)) {
                $validated_request['broker_id'] = $existingPayment->broker_id;
                $brokerProfitPercentage = 20;
                $brokerProfitCost = $amount * $brokerProfitPercentage / 100;

                $validated_request['broker_profit_percentage'] = $brokerProfitPercentage;
                $validated_request['broker_profit_cost'] = $brokerProfitCost;
            }
        }

        $gross_profit = $amount - ($brokerProfitCost ?? 0) - $validated_request['fees'];
        $validated_request['gross_profit'] = $gross_profit;

        $payment = CardPayment::create($validated_request);
        return new CardPaymentResource($payment);
    }

    public function show(CardPayment $payment)
    {
        return new CardPaymentResource($payment);
    }


//    public function update(CardPaymentUpdateRequest $request, CardPayment $payment)
//    {
//        $payment->update($request->all());
//        return new CardPaymentResource($payment);
//    }
//
//    public function destroy($id)
//    {
//        if (!CardPayment::findOrFail($id)->delete())
//            abort(403);
//    }
}
