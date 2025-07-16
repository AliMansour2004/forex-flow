<?php

namespace App\Http\Controllers;

use App\Helper\ControllersFunctionUtilities;
use App\Helper\ControllersHelpers\Files\UserControllerHelper;
use App\Http\Requests\FindRequest;
use App\Http\Requests\Users\UserIndexRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\BrokerBonus;
use App\Models\BrokerMemberBonus;
use App\Models\CardPayment;
use App\Models\Member;
use App\Models\MemberSubscription;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserIndexRequest $request)
    {
        $user = Auth::user();
        $query = User::query()->with('roles');
        if (!$user->hasRole('admin')) {
            $query->where('id', $user->id);
        }
        $total = $query->count();

        if ($request->filled('id')) {
            $query->whereIn('id', $request->id);
        }

        ControllersFunctionUtilities::applySort($query, $request->input('sort_key'), $request->input('sort_direction', 'asc'));

        $users = ControllersFunctionUtilities::paginateQuery($query, $request->input('per_page', 10), $total);

        return UserResource::collection($users);
    }

    public function show(Request $request)
    {
        $authUser = Auth::user()->load('latestCardPayment');
        return new UserResource($authUser);
    }


    public function find(FindRequest $request): JsonResponse
    {
        return (new UserControllerHelper())->findUserRecord($request, new User());
    }

    public function store(UserStoreRequest $request)
    {
        $validated_request = $request->validated();
        $validated_request['password'] = Hash::make($validated_request['password']);
        $validated_request['added_by_user_id'] = Auth::id();
        $date_of_birth = $validated_request['date_of_birth'] ?? null;

        $amount = $validated_request['amount'];
        $duration = $validated_request['duration'];
        $transaction_id = $validated_request['transaction_id'] ?? null;
        $discount = $validated_request['discount'] ?? null;
        $our_company_money_account_id = $validated_request['our_company_money_account_id'] ?? null;


        $fees = 0;
        if (!empty($validated_request['our_company_money_account_id'])) {
            $account_fees = [
                1 => 0.3,
                2 => 2
            ];
            $fees = $account_fees[$validated_request['our_company_money_account_id']] ?? null;
        }

        $broker_profit_cost = null;
        if (!empty($validated_request['parent_id'])) {
            $broker_profit_percentage = 20;
            $broker_profit_cost = $amount * $broker_profit_percentage / 100;
        }

        $user = User::create(
            collect($validated_request)
                ->except(['amount', 'fees', 'duration', 'our_company_money_account_id', 'transaction_id', 'discount'])
                ->toArray()
        );

        $role = $validated_request['role'];
        $user->assignRole($role === 'instructor' ? 'instructor' : 'member');

        if ($role != 'instructor') {
            $card_payment = CardPayment::create([
                'broker_id' => $validated_request['parent_id'] ?? null,
                'user_id' => $user->id,
                'added_by_user_id' => Auth::id(),
                'amount' => $amount,
                'fees' => $fees,
                'duration' => (int)$duration,
                'our_company_money_account_id' => $our_company_money_account_id,
                'transaction_id' => $transaction_id,
                'discount' => $discount,
                'broker_profit_percentage' => $broker_profit_percentage ?? null,
                'broker_profit_cost' => $broker_profit_cost,
                'gross_profit' => $amount - ($broker_profit_cost ?? 0) - $fees,
                'purchased_at' => now(),
                'finished_at' => now()->addMonths((int)$duration)->addDay(),
            ]);

            if ($card_payment) {
                MemberSubscription::create([
                    'user_id' => $user->id,
                    'added_by_user_id' => Auth::id(),
                    'finished_at' => Carbon::now()->addMonth(),
                ]);

                if (!empty($validated_request['parent_id'])) {
                    User::where('id', $validated_request['parent_id'])->increment('balance', $broker_profit_cost);
                    $this->handleBrokerBonuses($validated_request['parent_id']);
                }
            }
        }

        return new UserResource($user);
    }

    private function handleBrokerBonuses($broker_id)
    {
        $card_payment_record = CardPayment::where('broker_id', $broker_id)->first();
        if (!$card_payment_record) return;

        $active_user_count = CardPayment::where('broker_id', $broker_id)->where('purchased_at', '<=', Carbon::now()->addMonth())->count();

        if ($active_user_count === 1) {
            $parent_user = User::find($broker_id);
            $parent_user?->syncRoles('broker');
        }

        if ($active_user_count % 5 == 0) {
            $bonus_record = BrokerBonus::where('active_member_count', $active_user_count)->first();
            if ($bonus_record) {
                $entitlement_amount = $active_user_count * $bonus_record->bonus_per_member_per_month;
                $next_entitlement_at = Carbon::now()->addMonth();

                $broker_member_bonus_record = BrokerMemberBonus::where('broker_id', $broker_id)->where('next_entitlement_at', '>=', Carbon::now())->first();
                if ($broker_member_bonus_record) {
                    $old_entitlement_amount = $broker_member_bonus_record->entitlement_amount;
                    $entitlement_amount = $entitlement_amount - $old_entitlement_amount;
                }

                $broker_bonus = BrokerMemberBonus::create([
                    'broker_id' => $broker_id,
                    'member_count' => $active_user_count,
                    'bonus_per_member_per_month' => $bonus_record->bonus_per_member_per_month,
                    'entitlement_at' => now(),
                    'next_entitlement_at' => $next_entitlement_at,
                    'entitlement_amount' => $entitlement_amount,
                ]);

                if ($broker_bonus) {
                    User::where('id', $broker_id)->increment('balance', $entitlement_amount);
                }
            }
        }
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $validated_data = $request->validated();

        if (array_key_exists('parent_id', $validated_data)) {
            $old_parent_id = $user->parent_id;
            $new_parent_id = $validated_data['parent_id'];

            if ($old_parent_id !== $new_parent_id) {
                $user->update(['parent_id' => $new_parent_id]);

                CardPayment::where('user_id', $user->id)
                    ->where('broker_id', $old_parent_id)
                    ->update(['broker_id' => $new_parent_id]);

                $duration = $validated_data['duration'] ?? 1;

                if (!is_null($old_parent_id) || !is_null($new_parent_id)) {
                    $this->adjustMemberCount($old_parent_id, $new_parent_id, $duration);
                }
            }

            unset($validated_data['parent_id']);
        }

        $user->update($validated_data);

        return new JsonResponse(new UserResource($user));
    }

    private function updateRelatedTables($user_id, $old_parent_id, $new_parent_id)
    {
        CardPayment::where('user_id', $user_id)
            ->where('broker_id', $old_parent_id)
            ->update(['broker_id' => $new_parent_id]);
    }

    private function adjustMemberCount($old_broker_id = null, $new_broker_id = null, $duration)
    {
        if (!is_null($old_broker_id)) {
            $member_count = $this->getMemberCount($old_broker_id);
            $this->processBrokerMemberCount($old_broker_id, $member_count, 'subtract', $duration);
        }

        if (!is_null($new_broker_id)) {
            $member_count = $this->getMemberCount($new_broker_id);
            $this->processBrokerMemberCount($new_broker_id, $member_count, 'add', $duration);
        }
    }

    private function getMemberCount($broker_id)
    {
        return CardPayment::where('broker_id', $broker_id)
            ->where('purchased_at', '<=', now())
            ->where('finished_at', '>=', now())
            ->count();
    }

    private function processBrokerMemberCount($broker_id, $member_count, $operation, $duration = null)
    {
        var_dump($broker_id);
        if ($member_count < 5) {
            BrokerMemberBonus::where('broker_id', $broker_id)->delete();
            return;
        }

        $bonus_record = BrokerBonus::where('active_member_count', '<=', $member_count)
            ->orderBy('active_member_count', 'desc')
            ->first();
        $entitlement_amount = $member_count * $bonus_record->bonus_per_member_per_month;
        if ($bonus_record) {
            $next_entitlement_at = $operation === 'subtract' ? now()->subMonths((int)$duration) : now()->addMonths((int)$duration);

            BrokerMemberBonus::create([
                'broker_id' => $broker_id,
                'member_count' => $member_count,
                'bonus_per_member_per_month' => $bonus_record->bonus_per_member_per_month,
                'entitlement_at' => now(),
                'next_entitlement_at' => $next_entitlement_at,
                'entitlement_amount' => $entitlement_amount,
            ]);
            //todo::work on the balance update
        }
        var_dump($broker_id);
        if ($operation === 'subtract') {
            User::where('id', $broker_id)->decrement('balance', $entitlement_amount);
        } else {
            User::where('id', $broker_id)->increment('balance', $entitlement_amount);
        }
    }



    public function destroy(User $user)
    {
        //
    }



}
