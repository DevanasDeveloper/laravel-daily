<?php

namespace App\Repositories;

use App\Enums\EnumStatus;
use App\Http\Resources\CustomerResource;
use App\Models\User;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface{

    public function all(): array{
        return CustomerResource::collection(User::whereIsCustomer()->get())->toArray(request());
    }

    public function create(array $data): User{
        return User::create($data);
    }

    public function update(User $customer,array $data): Bool{
        return $customer->update($data);
    }

    public function find(Int $id): ?User{
        return User::whereisCustomer()->find($id);
    }

    public function delete(User $customer): bool{
        return $customer->delete();
    }

    public function changeStatus(User $customer): bool{
        $customer->status = ($customer->status == EnumStatus::ACTIVE ? EnumStatus::INACTIVE : EnumStatus::ACTIVE);
        return $customer->save();
    }
}
