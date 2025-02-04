<?php

namespace App\Repositories\Interfaces;

use App\Enums\EnumOrderStatus;
use App\Models\Order;

interface OrderRepositoryInterface {

    public function all(): array;
    public function create(array $data): Order;
    public function find(Int $id): ?Order;
    public function delete(Order $model): bool;
    public function changeStatus(Order $model, EnumOrderStatus $status): ?bool;
}