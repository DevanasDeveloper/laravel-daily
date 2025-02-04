<?php 

namespace App\Services\PaymentGateWay;

use App\Enums\EnumGateWay;

class PaymentGateWayFactory {
    public static function make(EnumGateWay $gateway) : PaymentGateWayInterface{
        return match ($gateway) {
            EnumGateWay::STRIPE => new StripeGateWay(),
            EnumGateWay::PAYPAL => new PayPalGateWay(),
            EnumGateWay::CASH => new CashGateWay(),
            default => throw new \Exception('Payment gateway not found'),
        };
    }
}