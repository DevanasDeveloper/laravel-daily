<?php

namespace App\Models;

use App\Enums\EnumStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Enum;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'status'
    ];

    protected $casts = [
        'status' => EnumStatus::class
    ];

    public function user(){
        return $this->belongsTo(User::class);
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
