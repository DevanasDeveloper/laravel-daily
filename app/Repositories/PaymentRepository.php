<?php

namespace App\Repositories;

use App\Enums\EnumPaymentStatus;
use App\Http\Resources\PaymentResource;
use App\Models\Order;
use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface{

    private Payment $model;

    public function __construct(Payment $model)
    {
        $this->model = $model;   
    }

    public function findByOrder(Order $order): array
    {
        return PaymentResource::collection($order->payments)->toArray(request());
    }

    public function create(array $data): Payment{
        return $this->model->create($data);
    }

    public function update(Payment $model,array $data): Bool{
        return $model->update($data);
    }

    public function find(Int $id): ?Payment{
        return $this->model->find($id);
    }

    public function delete(Payment $model): bool{
        return $model->delete();
    }

    public function changeStatus(Payment $model,EnumPaymentStatus $status): bool{
        $model->payment_status = $status;
        return $model->save();
    }
}
