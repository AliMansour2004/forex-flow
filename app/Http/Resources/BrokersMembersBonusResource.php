<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrokersMembersBonusResource extends JsonResource
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
            'broker_id' => $this->broker_id,
            'member_count' => $this->member_count,
            'bonus_per_member_per_month' => $this->bonus_per_member_per_month,
            'entitlement_at' => $this->entitlement_at,
            'next_entitlement_at' => $this->next_entitlement_at,
            'entitlement_amount' => $this->entitlement_amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
