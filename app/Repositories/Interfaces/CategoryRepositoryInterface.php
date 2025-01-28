<?php

namespace App\Repositories\Interfaces;
use App\Models\Category;

interface CategoryRepositoryInterface {

    public function all(): array;
    public function create(array $data): Category;
    public function update(Category $category,array $data): Bool;
    public function find(Int $id): ?Category;
    public function delete(Category $category): bool;
    public function changeStatus(Category $category): bool;

}