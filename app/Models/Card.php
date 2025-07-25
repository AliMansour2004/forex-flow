<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'duration',
        'discount',
        'broker_percentage',
        'broker_profit_cost',
    ];

}
