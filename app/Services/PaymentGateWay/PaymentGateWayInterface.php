<?php

namespace App\Services\PaymentGateWay;

use App\Models\Payment;

interface PaymentGateWayInterface
{
    public function charge(array $data) : array;
    public function refund(Payment $model) : bool;
}