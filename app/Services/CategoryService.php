<?php

namespace App\Services;

use App\DTOs\CategoryDTO;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class CategoryService {
    
    private $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories(): array {
        return $this->categoryRepository->all();
    }

    public function createCategory(CategoryDTO $categoryDTO) {
        $data = [
            'name' => $categoryDTO->name,
            'status' => $categoryDTO->status
        ];
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(Category $model, CategoryDTO $categoryDTO) : Bool {
        $data = [
            'name' => $categoryDTO->name,
            'status' => $categoryDTO->status
        ];
        return $this->categoryRepository->update($model, $data);
    }

    public function getCategory(Int $id): ?Category {
        return $this->categoryRepository->find($id);
    }

    public function deleteCategory(Category $model): bool {
        return $this->categoryRepository->delete($model);
    }

    public function changeStatusCategory(Category $model): bool {
        return $this->categoryRepository->changeStatus($model);
    }

}