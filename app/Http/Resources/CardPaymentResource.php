<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'full_name' => $this->user->first_name . ' ' . $this->user->middle_name . ' ' . $this->user->last_name,
            'amount' => $this->amount,
            'fees' => $this->fees,
            'time' => $this->time,
            'discount' => $this->discount,
//            'cost' => $this->cost,
            'purchased_at' => optional($this->purchased_at)->format('Y-m-d'),
            'finished_at' => optional($this->finished_at)->format('Y-m-d'),
            'broker_id' => $this->broker_id,
            'broker_profit_percentage' => $this->broker_profit_percentage,
            'broker_profit_cost' => $this->broker_profit_cost,
            'gross_profit' => $this->gross_profit,

        ];
    }
}
