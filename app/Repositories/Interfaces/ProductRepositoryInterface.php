<?php

namespace App\Repositories\Interfaces;
use App\Models\Product;

interface ProductRepositoryInterface {

    public function all(): array;
    public function create(array $data): Product;
    public function update(Product $product,array $data): Bool;
    public function find(Int $id): ?Product;
    public function delete(Product $product): bool;
    public function changeStatus(Product $product): bool;

}