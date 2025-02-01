<?php

namespace App\Repositories\Interfaces;
use App\Models\Category;

interface CategoryRepositoryInterface {

    public function all(): array;
    public function create(array $data): Category;
    public function update(Category $model,array $data): Bool;
    public function find(Int $id): ?Category;
    public function delete(Category $model): bool;
    public function changeStatus(Category $model): bool;

}