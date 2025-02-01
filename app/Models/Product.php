<?php

namespace App\Models;

use App\Enums\EnumStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'image',
        'name',
        'description',
        'quantity',
        'price',
        'status'
    ];

    protected $casts = [
        'status' => EnumStatus::class
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function isActive() : bool{
        return $this->status === EnumStatus::ACTIVE;
    }

    public function isNotActive() : bool{
        return $this->status === EnumStatus::INACTIVE;
    }


}
