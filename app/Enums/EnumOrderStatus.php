<?php

namespace App\Enums;

enum EnumOrderStatus: string{
    case PAID = 'paid';
    case UNPAID = 'unpaid';
    case CANCLED = 'cancled';

    public static function values()
    {
        return [
            self::PAID,
            self::UNPAID,
            self::CANCLED
        ];
    }
}