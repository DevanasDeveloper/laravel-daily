<?php

namespace App\Repositories;

use App\Enums\EnumStatus;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{

    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all(): array{
        return UserResource::collection($this->model->whereIsUser()->get())->toArray(request());
    }

    public function create(array $data): User{
        return $this->model->create($data);
    }

    public function update(User $model,array $data): Bool{
        return $model->update($data);
    }

    public function find(Int $id): ?User{
        return $this->model->whereIsUser()->find($id);
    }

    public function delete(User $model): bool{
        return $model->delete();
    }

    public function changeStatus(User $model): bool{
        $model->status = ($model->status == EnumStatus::ACTIVE ? EnumStatus::INACTIVE : EnumStatus::ACTIVE);
        return $model->save();
    }
}
