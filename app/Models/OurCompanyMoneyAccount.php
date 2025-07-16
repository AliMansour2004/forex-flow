<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurCompanyMoneyAccount extends Model
{
    use HasFactory;

    protected $fillable = ['money_transfer_company_id', 'name', 'phone_number'];

    public function moneyTransferCompany()
    {
        return $this->belongsTo(MoneyTransferCompany::class);
    }

    public function cardPayments()
    {
        return $this->hasMany(CardPayment::class);
    }

}
