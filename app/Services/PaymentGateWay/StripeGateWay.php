<?php

namespace App\Services\PaymentGateWay;

use App\Models\Payment;

class StripeGateWay implements PaymentGateWayInterface
{
    public function charge(array $data) : array {
        return [
            "status" => true,
            "transaction_id" => uniqid()
        ];
    }

    public function refund(Payment $model): bool
    {
        return true;
    }
}