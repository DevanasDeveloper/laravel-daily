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
        'name',
        'status'
    ];

    protected $casts = [
        'status' => EnumStatus::class
    ];

    public function isActive() : bool{
        return $this->status === EnumStatus::ACTIVE;
    }

    public function isNotActive() : bool{
        return $this->status === EnumStatus::INACTIVE;
    }


}
