<?php

namespace App\Enums;

enum EnumPaymentStatus: string{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';

    public static function values()
    {
        return [
            self::PENDING,
            self::COMPLETED,
            self::FAILED
        ];
    }
}