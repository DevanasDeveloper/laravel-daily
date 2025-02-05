<?php

namespace App\Models;

use App\Enums\EnumGateWay;
use App\Enums\EnumPaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'payment_status',
        'transaction_id'
    ];

    protected $casts = [
        'payment_method' => EnumGateWay::class,
        'payment_status' => EnumPaymentStatus::class,
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
