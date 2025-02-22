<?php

namespace App\Services;

use App\DTOs\ProductDTO;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class ProductService {
    
    private $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): array {
        return $this->productRepository->all();
    }

    public function createProduct(ProductDTO $productDTO) {
        $data = [
            'image' => $productDTO->image,
            'category_id' => $productDTO->category_id,
            'name' => $productDTO->name,
            'description' => $productDTO->description,
            'quantity' => $productDTO->quantity,
            'price' => $productDTO->price,
            'status' => $productDTO->status
        ];
        return $this->productRepository->create($data);
    }

    public function updateProduct(Product $model, ProductDTO $productDTO) : Bool {
        $data = [
            'image' => $productDTO->image,
            'category_id' => $productDTO->category_id,
            'name' => $productDTO->name,
            'description' => $productDTO->description,
            'quantity' => $productDTO->quantity,
            'price' => $productDTO->price,
            'status' => $productDTO->status
        ];
        return $this->productRepository->update($model, $data);
    }

    public function getProduct(Int $id): ?Product {
        return $this->productRepository->find($id);
    }

    public function deleteProduct(Product $model): bool {
        return $this->productRepository->delete($model);
    }

    public function changeStatusProduct(Product $model): bool {
        return $this->productRepository->changeStatus($model);
    }

}