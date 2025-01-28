<?php

namespace App\Enums;

enum EnumStatus: string{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public static function values()
    {
        return [
            self::ACTIVE,
            self::INACTIVE
        ];
    }
}