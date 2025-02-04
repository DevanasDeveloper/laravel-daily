<?php

namespace App\Services\PaymentGateWay;

use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\PaymentRepository;

class CashGateWay implements PaymentGateWayInterface
{
    public function charge(array $data) : array {
        return [
          "status" => true,
          "transaction_id" => null
        ];
    }

    public function refund(Payment $model): bool
    {
        return true;
    }
}