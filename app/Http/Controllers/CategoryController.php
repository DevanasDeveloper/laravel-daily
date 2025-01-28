<?php

namespace App\Http\Controllers;

use App\DTOs\CategoryDTO;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends BaseController
{
    private CategoryService $CategoryService;

    public function __construct(CategoryService $CategoryService) {
        $this->CategoryService = $CategoryService;
    }

    public function index() {
        try {
            $Categorys = $this->CategoryService->getAllCategories();
            return $this->sendSuccess($Categorys,"Categories retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Categories not retrieved",$th->getMessage());
        }
    }

    public function show($id) {
        try {
            $Category = $this->CategoryService->getCategory($id);
            return $this->sendSuccess(CategoryResource::make($Category),"Category retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Category not retrieved",$th->getMessage());
        }
    }

    public function store(CategoryRequest $request) {
        try{
            $Category = $this->CategoryService->createCategory(CategoryDTO::fromRequest($request));
            return $this->sendSuccess(CategoryResource::make($Category),"Category created successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Category not created",$th->getMessage());
        }
        
    }

    public function update(CategoryRequest $request, $id) {
        try{
            $Category = $this->CategoryService->getCategory($id);
            $this->CategoryService->updateCategory($Category, CategoryDTO::fromRequest($request));
            return $this->sendSuccess(CategoryResource::make($Category),"Category updated successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Category not updated",$th->getMessage());
        }
        
    }

    public function destroy($id) {
        try{
            $Category = $this->CategoryService->getCategory($id);
            $this->CategoryService->deleteCategory($Category);
            return $this->sendSuccess(CategoryResource::make($Category),"Category deleted successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Category not deleted",$th->getMessage());
        }
        
    }

    public function changeStatus($id) {
        try{
            $Category = $this->CategoryService->getCategory($id);
            $this->CategoryService->changeStatusCategory($Category);
            return $this->sendSuccess(CategoryResource::make($Category),"Category status changed successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Category status not changed",$th->getMessage());
        }
    }
}