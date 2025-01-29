<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\EnumStatus;
use App\Enums\EnumRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'fullname',
        'email',
        'phone',
        'address',
        'status',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => EnumStatus::class,
        'role' => EnumRole::class
    ];

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function isActive() : bool{
        return $this->status === EnumStatus::ACTIVE;
    }

    public function isNotActive() : bool{
        return $this->status === EnumStatus::INACTIVE;
    }

    public function isAdmin() : bool{
        return $this->role === EnumRole::ADMIN;
    }

    public function isUser() : bool{
        return $this->role === EnumRole::USER;
    }
}
