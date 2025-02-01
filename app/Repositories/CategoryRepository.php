<?php

namespace App\Repositories;

use App\Enums\EnumStatus;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Validation\Rules\In;

class CategoryRepository implements CategoryRepositoryInterface{

    private Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function all(): array{
        return CategoryResource::collection($this->model->all())->toArray(request());
    }

    public function create(array $data): Category{
        return $this->model->create($data);
    }

    public function update(Category $model,array $data): Bool{
        return $model->update($data);
    }

    public function find(Int $id): ?Category{
        return $this->model->find($id);
    }

    public function delete(Category $model): bool{
        return $model->delete();
    }

    public function changeStatus(Category $model): bool{
        $model->status = ($model->status == EnumStatus::ACTIVE ? EnumStatus::INACTIVE : EnumStatus::ACTIVE);
        return $model->save();
    }
}
