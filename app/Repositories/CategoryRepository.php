<?php

namespace App\Repositories;

use App\Enums\EnumStatus;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Validation\Rules\In;

class CategoryRepository implements CategoryRepositoryInterface{

    public function all(): array{
        return CategoryResource::collection(Category::byUser()->get())->toArray(request());
    }

    public function create(array $data): Category{
        return auth()->user()->categories()->create($data);
    }

    public function update(Category $category,array $data): Bool{
        return $category->update($data);
    }

    public function find(Int $id): ?Category{
        return Category::byUser()->find($id);
    }

    public function delete(Category $category): bool{
        return $category->delete();
    }

    public function changeStatus(Category $category): bool{
        $category->status = ($category->status == EnumStatus::ACTIVE ? EnumStatus::INACTIVE : EnumStatus::ACTIVE);
        return $category->save();
    }
}
