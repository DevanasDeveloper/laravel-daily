<?php

namespace App\DTOs;

use App\Enums\EnumOrderStatus;

class OrderDTO
{

    public function __construct(
        public string $customer_id,
        public float $total = 0.0,
        public EnumOrderStatus $status = EnumOrderStatus::UNPAID
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            customer_id: $request->input('customer_id'),
            total: $request->input('total'),
            status: EnumOrderStatus::from($request->input('status', EnumOrderStatus::UNPAID->value))
        );
    }
}
