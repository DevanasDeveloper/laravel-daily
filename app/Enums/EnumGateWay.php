<?php

namespace App\Enums;

enum EnumGateWay: string{
    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
    case CASH = 'cash';

    public static function values()
    {
        return [
            self::PAYPAL,
            self::STRIPE,
            self::CASH
        ];
    }
}