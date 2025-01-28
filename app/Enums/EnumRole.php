<?php

namespace App\Enums;

enum EnumRole: string{
    case ADMIN = 'admin';
    case USER = 'user';

    public static function values()
    {
        return [
            self::ADMIN,
            self::USER
        ];
    }
}