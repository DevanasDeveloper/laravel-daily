<?php

namespace App\DTOs;

use App\Enums\EnumStatus;

class ProductDTO
{

    public function __construct(
        public string $category_id,
        public ?string $image = null,
        public string $name,
        public string $description,
        public Int $quantity = 0,
        public float $price = 0.0,
        public EnumStatus $status = EnumStatus::INACTIVE
    ) {}

    public static function fromRequest($request, $imagePath): self
    {
        return new self(
            category_id: $request->input('category_id'),
            image: $imagePath,
            name: $request->input('name'),
            description: $request->input('description'),
            quantity: $request->input('quantity'),
            price: $request->input('price'),
            status: EnumStatus::from($request->input('status', EnumStatus::INACTIVE->value))
        );
    }
}
