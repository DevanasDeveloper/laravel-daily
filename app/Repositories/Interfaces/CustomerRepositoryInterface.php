<?php

namespace App\Repositories\Interfaces;
use App\Models\User;

interface CustomerRepositoryInterface {

    public function all(): array;
    public function create(array $data): User;
    public function update(User $model,array $data): Bool;
    public function find(Int $id): ?User;
    public function delete(User $model): bool;
    public function changeStatus(User $model): bool;

}