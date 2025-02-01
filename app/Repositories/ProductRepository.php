<?php

namespace App\Repositories;

use App\Enums\EnumStatus;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface{

    public function all(): array{
        return ProductResource::collection(Product::byUser()->get())->toArray(request());
    }

    public function create(array $data): Product{
        return auth()->user()->products()->create($data);
    }

    public function update(Product $product,array $data): Bool{
        return $product->update($data);
    }

    public function find(Int $id): ?Product{
        return Product::byUser()->find($id);
    }

    public function delete(Product $product): bool{
        return $product->delete();
    }

    public function changeStatus(Product $product): bool{
        $product->status = ($product->status == EnumStatus::ACTIVE ? EnumStatus::INACTIVE : EnumStatus::ACTIVE);
        return $product->save();
    }
}
