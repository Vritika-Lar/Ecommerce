<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable = [
        'order_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
