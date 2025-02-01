<?php

namespace App\Repositories;

use App\Enums\EnumStatus;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{

    public function all(): array{
        return UserResource::collection(User::all())->toArray(request());
    }

    public function create(array $data): User{
        return User::create($data);
    }

    public function update(User $user,array $data): Bool{
        return $user->update($data);
    }

    public function find(Int $id): ?User{
        return User::find($id);
    }

    public function delete(User $user): bool{
        return $user->delete();
    }

    public function changeStatus(User $user): bool{
        $user->status = ($user->status == EnumStatus::ACTIVE ? EnumStatus::INACTIVE : EnumStatus::ACTIVE);
        return $user->save();
    }
}
