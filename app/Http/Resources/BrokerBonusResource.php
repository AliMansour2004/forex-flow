<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrokerBonusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $referralCommission = 6;
        $people = $this->active_member_count;
        $bonusPerMember = $this->bonus_per_member_per_month;

        return [
            'no_of_people' => $people,
            'commission_per_referral' => $referralCommission,
            'total_commission_received' => $referralCommission * $people,
            'extra_bonus' => round($bonusPerMember * $people),
        ];
    }
}
