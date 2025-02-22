<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_data',
        'quantity',
        'price',
        'total'
    ];

    protected $casts = [
        'product_data' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductModelAttribute()
    {
        $product = new product($this->product_data);
        $product->id = $this->product_id;
        return $product;
    }
}
