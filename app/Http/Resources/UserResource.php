<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'parent_name' => $this->parent ? $this->parent->first_name . ' ' . $this->parent->last_name : null,
            'subscription_finished_at' => $this->latestCardPayment
                ? optional($this->latestCardPayment->finished_at)->format('Y-m-d')
                : null,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'user_name' => $this->user_name,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'balance' => $this->balance,
            'is_active' => $this->is_active,
            'is_our_tbroker_account_open' => $this->is_our_tbroker_account_open,
            'our_tbroker_server_name' => $this->our_tbroker_server_name,
            'our_tbroker_account_number' => $this->our_tbroker_account_number,
            'roles' => $this->getRoleNames()
        ];
    }
}
