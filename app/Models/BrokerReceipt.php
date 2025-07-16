<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrokerReceipt extends Model
{
    use HasFactory;

    protected $fillable = ['our_company_money_account_id', 'amount', 'receipt_at', 'transaction_id', 'added_by_user_id'];

    public function ourCompanyMoneyAccount()
    {
        return $this->belongsTo(OurCompanyMoneyAccount::class, 'our_company_money_account_id');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by_user_id');
    }
}
