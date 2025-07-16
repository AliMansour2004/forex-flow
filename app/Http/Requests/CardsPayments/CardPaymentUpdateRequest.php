<?php
//
//namespace App\Http\Requests\CardsPayments;
//
//use Illuminate\Foundation\Http\FormRequest;
//
//class CardPaymentUpdateRequest extends FormRequest
//{
//    public function authorize(): bool
//    {
//        return true;
//    }
//
//    public function rules(): array
//    {
//        return [
//            'amount' => 'sometimes|required|numeric',
//            'duration' => 'sometimes|required|integer',
//            'discount' => 'sometimes|required|numeric',
////            'cost' => 'sometimes|required|numeric',
//            'fees.required' => 'The fees field is required',
//            'fees.numeric' => 'The fees must be a number.',
//            'purchased_at' => 'sometimes|required|date',
//            'broker_id' => 'nullable|exists:users,id',
//            'user_id' => 'required|exists:users,id',
//            'broker_profit_percentage' => 'nullable|required|numeric',
//            'broker_profit_cost' => 'nullable|required|numeric',
//            'gross_profit.required' => 'The gross_profit field is required.',
//            'gross_profit.numeric' => 'The fees must be a number.'
//        ];
//    }
//
//    public function messages()
//    {
//        return [
//            'amount.required' => 'The amount field is required.',
//            'amount.numeric' => 'The amount must be a number.',
//            'duration.required' => 'The duration field is required.',
//            'duration.integer' => 'The duration must be an integer.',
//            'discount.required' => 'The discount field is required.',
//            'discount.numeric' => 'The discount must be a number.',
////            'cost.required' => 'The cost field is required.',
////            'cost.numeric' => 'The cost must be a number.',
//            'fees.required' => 'The fees field is required',
//            'fees.numeric' => 'The fees must be a number.',
//            'purchased_at.required' => 'The purchased at field is required.',
//            'purchased_at.date' => 'The purchased at must be a valid date.',
//            'user_id.required' => 'The user_id field is required',
//            'user_id.exists' => 'The selected user ID is invalid.',
//            'broker_id.exists' => 'The selected broker ID is invalid.',
//            'broker_profit_percentage.numeric' => 'The broker profit percentage must be a number.',
//            'broker_profit_cost.numeric' => 'The broker profit cost must be a number.',
//        ];
//    }
//}
