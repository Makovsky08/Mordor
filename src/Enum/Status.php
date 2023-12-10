<?php
declare(strict_types=1);

namespace App\Enum;

enum Status: string
{
    const APPROVED = 'schváleno';
    const REJECTED = 'odmítnuto';
    const RETURNED = 'vráceno';

    public static function getValues(): array
    {
        return [
            self::APPROVED => 'Schváleno',
            self::REJECTED => 'Odmítnuto',
            self::RETURNED => 'Vráceno',
        ];
    }

    public static function values(): array
    {
        return array_map(fn(self $v) => $v->value, self::cases());
    }
}
