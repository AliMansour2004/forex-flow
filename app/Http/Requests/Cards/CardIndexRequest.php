<?php
namespace App\Http\Requests\Cards;

use Illuminate\Foundation\Http\FormRequest;

class CardIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return true;
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'per_page' => 'nullable|integer|min:1',
            'id' => 'nullable|array',
            'id.*' => 'nullable|exists:cards,id',
            'amount' => 'nullable|numeric',
            'duration' => 'nullable|integer',
            'discount' => 'nullable|numeric',
            'broker_percentage' => 'nullable|numeric',
            'broker_profit_cost' => 'nullable|numeric',
            'sortKey' => 'nullable|string',
            'sortDirection' => 'nullable|in:asc,desc',
        ];
    }
}
