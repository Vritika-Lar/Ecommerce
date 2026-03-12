<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'charge_id',
        'transaction_id',
        'amount',
        'currency',
        'card_id',
        'card_last_four',
        'card_exp_month',
        'card_exp_year',
        'postal_code',
    ];
}
