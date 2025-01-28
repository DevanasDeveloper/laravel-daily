<?php

namespace App\DTOs;

use App\Enums\EnumStatus;

class CategoryDTO
{

    public function __construct(
        public string $name,
        public EnumStatus $status = EnumStatus::INACTIVE
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            name: $request->input('name'),
            status: EnumStatus::from($request->input('status', EnumStatus::INACTIVE->value))
        );
    }
}
