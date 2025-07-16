<?php

namespace App\Http\Controllers;

use App\Helper\ControllersHelpers\Files\MemberControllerHelper;
use App\Http\Requests\MemberSubscriptions\MemberSubscriptionIndexRequest;
use Illuminate\Routing\Controller;
use App\Http\Requests\MemberSubscriptions\MemberSubscriptionStoreRequest;
use App\Models\MemberSubscription;
use App\Http\Resources\MemberSubscriptionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberSubscriptionController extends Controller
{
    public function index(MemberSubscriptionIndexRequest $request)
    {
        return (new MemberControllerHelper)
            ->pagingSearchData($request, new MemberSubscription(), MemberSubscriptionResource::class);
    }

    public function find(Request $request): JsonResponse
    {
        $subscription = MemberSubscription::where('user_id', $request->input('user_id'))->first();
        return response()->json(['data' => $subscription]);
    }

    public function store(MemberSubscriptionStoreRequest $request)
    {
        $validatedRequest = $request->validated();
        $validatedRequest['added_by_user_id'] = Auth::id();
        $subscription = MemberSubscription::create($validatedRequest);
        return new MemberSubscriptionResource($subscription);
    }

    public function show(MemberSubscription $memberSubscription)
    {
        return new MemberSubscriptionResource($memberSubscription);
    }
}
