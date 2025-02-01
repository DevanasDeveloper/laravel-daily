<?php

namespace App\Enums;

enum EnumRole: string{
    case ADMIN = 'admin';
    case USER = 'user';
    case CUSTOMER = 'customer';

    public static function values()
    {
        return [
            self::ADMIN,
            self::USER,
            self::CUSTOMER
        ];
    }
}