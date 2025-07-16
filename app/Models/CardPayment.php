<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPayment extends Model
{
    use HasFactory;

    protected $fillable = ['added_by_user_id', 'our_company_money_account_id', 'broker_id', 'amount', 'fees', 'duration', 'discount',
//        'cost',
        'purchased_at', 'finished_at', 'broker_profit_percentage', 'broker_profit_cost', 'gross_profit', 'transaction_id', 'user_id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
        'purchased_at' => 'datetime:Y-m-d',
        'finished_at' => 'datetime:Y-m-d',
    ];

    public function broker()
    {
        return $this->belongsTo(User::class, 'broker_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by_user_id');
    }

    public function ourCompanyMoneyAccount()
    {
        return $this->belongsTo(OurCompanyMoneyAccount::class, 'our_company_money_account_id');
    }

}
