<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrokerBonus extends Model
{
    use HasFactory;

    protected $table = 'broker_bonuses';
    protected $fillable = [
        'active_member_count',
        'bonus_per_member_per_month',
    ];
}
