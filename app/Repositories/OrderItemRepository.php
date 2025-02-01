<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Interfaces\OrderItemRepositoryInterface;

class OrderItemRepository implements OrderItemRepositoryInterface{

    private OrderItem $model;

    public function __construct(OrderItem $model){
        $this->model = $model;
    }

    public function insert(array $data): bool{
        return $this->model->insert($data);
    }

    public function deleteByOrderId(Order $model): bool{
        return $model->order_items()->delete();
    }
}
