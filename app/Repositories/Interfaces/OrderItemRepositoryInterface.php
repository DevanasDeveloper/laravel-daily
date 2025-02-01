<?php

namespace App\Repositories\Interfaces;

use App\Models\Order;

interface OrderItemRepositoryInterface {

    public function insert(array $data): bool;
    public function deleteByOrderId(Order $model): bool;
}