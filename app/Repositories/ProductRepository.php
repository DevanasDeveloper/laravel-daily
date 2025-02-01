<?php

namespace App\Repositories;

use App\Enums\EnumStatus;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface{

    private Product $model;

    public function __construct(Product $model){
        $this->model = $model;
    }

    public function all(): array{
        return ProductResource::collection($this->model->all())->toArray(request());
    }

    public function create(array $data): Product{
        return $this->model->create($data);
    }

    public function update(Product $model,array $data): Bool{
        return $model->update($data);
    }

    public function find(Int $id): ?Product{
        return $this->model->find($id);
    }

    public function delete(Product $model): bool{
        return $model->delete();
    }

    public function changeStatus(Product $model): bool{
        $model->status = ($model->status == EnumStatus::ACTIVE ? EnumStatus::INACTIVE : EnumStatus::ACTIVE);
        return $model->save();
    }
}
