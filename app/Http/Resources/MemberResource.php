<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $authUser = auth()->user();
        $isBroker = $authUser && $authUser->hasRole('broker');
        $payment_info = $this->user && $this->user->cardsPayments ? $this->user->cardsPayments->sortByDesc('created_at')->first() : null;

        $payment_array = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_name' => $this->user->first_name . ' ' . $this->user->middle_name . ' ' . $this->user->last_name,
            'purchased_at' => $payment_info->purchased_at->format('Y-m-d'),
            'finished_at' => $payment_info->finished_at->format('Y-m-d'),
            'amount' => $payment_info->amount,
            'broker_profit_percentage' => $payment_info->broker_profit_percentage,
            'broker_profit_cost' => $payment_info->broker_profit_cost,
        ];

        if ($isBroker) {
            unset($payment_array['broker_profit_percentage']);
        }

        return $payment_array;

    }
}
