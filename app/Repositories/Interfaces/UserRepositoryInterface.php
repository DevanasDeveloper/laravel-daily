<?php

namespace App\Repositories\Interfaces;
use App\Models\User;

interface UserRepositoryInterface {

    public function all(): array;
    public function create(array $data): User;
    public function update(User $user,array $data): Bool;
    public function find(Int $id): ?User;
    public function delete(User $user): bool;
    public function changeStatus(User $user): bool;

}