<?php

namespace App\DTOs;

use App\Enums\EnumRole;
use App\Enums\EnumStatus;

class CustomerDTO
{

    public function __construct(
        public string $fullname,
        public string $email,
        public ?string $password = null,
        public string $phone,
        public string $address,
        public EnumStatus $status = EnumStatus::INACTIVE,
        public EnumRole $role = EnumRole::CUSTOMER
        
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            fullname: $request->input('fullname'),
            email: $request->input('email'),
            phone: $request->input('phone'),
            password: $request->input('password'),
            address: $request->input('address'),
            status: EnumStatus::from($request->input('status', EnumStatus::INACTIVE->value)),
            role: EnumRole::from($request->input('role', EnumRole::CUSTOMER->value))
        );
    }
}
