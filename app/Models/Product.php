<?php

namespace App\Models;

use App\Enums\EnumStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeByUser($query){
        return $query->where('user_id', auth()->user()->id);
    }

    public function isActive() : bool{
        return $this->status === EnumStatus::ACTIVE;
    }

    public function isNotActive() : bool{
        return $this->status === EnumStatus::INACTIVE;
    }


}
