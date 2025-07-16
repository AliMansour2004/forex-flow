<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrokerMemberBonus extends Model
{
    use HasFactory;

    protected $fillable = ['broker_id', 'member_count', 'bonus_per_member_per_month', 'entitlement_at', 'next_entitlement_at', 'entitlement_amount'];
    protected $table = 'brokers_members_bonuses';

    public function broker()
    {
        return $this->belongsTo(User::class, 'broker_id');
    }
}
