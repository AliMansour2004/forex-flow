<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrokersReceiptResource extends JsonResource
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
            'our_company_money_account_id' => $this->our_company_money_account_id,
            'amount' => $this->amount,
            'receipt_at' => $this->receipt_at,
            'transaction_id' => $this->transaction_id,
            'added_by_user_id' => $this->added_by_user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
