<?php

namespace App\Enums;

enum EnumOrderStatus: string{
    case PENDING = 'pending';
    case UNPAID = 'unpaid';
    case PAID = 'paid';
    case CANCLED = 'cancled';

    public static function values()
    {
        return [
            self::PENDING,
            self::PAID,
            self::UNPAID,
            self::CANCLED
        ];
    }
}