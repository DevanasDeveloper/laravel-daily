<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDTO;
use App\Http\Helper;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\productService;
use PHPUnit\TextUI\Help;

class ProductController extends BaseController
{
    private productService $productService;

    public function __construct(productService $productService) {
        $this->productService = $productService;
    }

    public function index() {
        try {
            $products = $this->productService->getAllProducts();
            return $this->sendSuccess($products,"Products retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Products not retrieved",$th->getMessage());
        }
    }

    public function show($id) {
        try {
            $product = $this->productService->getProduct($id);
            return $this->sendSuccess(ProductResource::make($product),"Product retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Product not retrieved",$th->getMessage());
        }
    }

    public function store(ProductRequest $request) {
        try{
            $imagePath = $this->handleImageUpload($request);
            $product = $this->productService->createProduct(ProductDTO::fromRequest($request,$imagePath));
            return $this->sendSuccess(ProductResource::make($product),"Product created successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Product not created",$th->getMessage());
        }
        
    }

    public function update(ProductRequest $request, $id) {
        try{
            $product = $this->productService->getProduct($id);
            $imagePath = $this->handleImageUpload($request);
            $this->productService->updateProduct($product, ProductDTO::fromRequest($request,$imagePath));
            return $this->sendSuccess(ProductResource::make($product),"Product updated successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Product not updated",$th->getMessage());
        }
        
    }

    public function destroy($id) {
        try{
            $product = $this->productService->getProduct($id);
            $this->productService->deleteProduct($product);
            return $this->sendSuccess(ProductResource::make($product),"Product deleted successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Product not deleted",$th->getMessage());
        }
        
    }

    public function changeStatus($id) {
        try{
            $product = $this->productService->getProduct($id);
            $this->productService->changeStatusProduct($product);
            return $this->sendSuccess(ProductResource::make($product),"Product status changed successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Product status not changed",$th->getMessage());
        }
    }

    private function handleImageUpload(ProductRequest $request) {
        if($request->hasFile('image')){
            return Helper::uploadFile($request->file('image'),"storage/uploads/product/","public/uploads/product");
        }else if($request->has('image_url') && !empty($request->image_url)){
            return $request->image_url;
        }
        return null;
    }
}