<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'amount' => $this->amount,
            'duration' => $this->duration,
            'discount' => $this->discount,
            'broker_percentage' => $this->broker_percentage,
            'broker_profit_cost' => $this->broker_profit_cost,
        ];
    }
}
