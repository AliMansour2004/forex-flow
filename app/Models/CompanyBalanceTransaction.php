<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBalanceTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['added_by_user_id', 'our_company_account_id', 'amount', 'reference_id', 'date', 'description'];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by_user_id');
    }

    public function ourCompanyMoneyAccount()
    {
        return $this->belongsTo(OurCompanyMoneyAccount::class, 'our_company_money_account_id');
    }
}
