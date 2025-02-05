<?php

namespace App\Models;

use App\Enums\EnumOrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total',
        'status',
    ];

    protected $casts = [
        'status' => EnumOrderStatus::class
    ];

    public function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
