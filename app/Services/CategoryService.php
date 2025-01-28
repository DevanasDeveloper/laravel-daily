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

    public function createCategory(CategoryDTO $CategoryDTO) {
        $data = [
            'name' => $CategoryDTO->name,
            'status' => $CategoryDTO->status
        ];
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(Category $Category, CategoryDTO $CategoryDTO) : Bool {
        $data = [
            'name' => $CategoryDTO->name,
            'status' => $CategoryDTO->status
        ];
        return $this->categoryRepository->update($Category, $data);
    }

    public function getCategory(Int $id): ?Category {
        return $this->categoryRepository->find($id);
    }

    public function deleteCategory(Category $Category): bool {
        return $this->categoryRepository->delete($Category);
    }

    public function changeStatusCategory(Category $Category): bool {
        return $this->categoryRepository->changeStatus($Category);
    }

}