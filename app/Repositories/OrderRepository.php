<?php

namespace App\Repositories;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface{

    private Order $model;

    public function __construct(Order $model){
        $this->model = $model;
    }

    public function all(): array{
        return OrderResource::collection($this->model->all())->toArray(request());
    }

    public function create(array $data): Order{
        return $this->model->create($data);
    }
    public function find(Int $id): ?Order{
        return $this->model->find($id);
    }

    public function delete(Order $model): bool{
        return $model->delete();
    }
}
