<?php

namespace App\Repositories\Interfaces;

use App\Enums\EnumPaymentStatus;
use App\Models\Order;
use App\Models\Payment;

interface PaymentRepositoryInterface {

    public function findByOrder(Order $order): array;
    public function create(array $data): Payment;
    public function update(Payment $model,array $data): Bool;
    public function find(Int $id): ?Payment;
    public function delete(Payment $model): bool;
    public function changeStatus(Payment $model,EnumPaymentStatus $status): bool;

}