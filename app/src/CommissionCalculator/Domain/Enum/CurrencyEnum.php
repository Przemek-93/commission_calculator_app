<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\Enum;

enum CurrencyEnum: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case GBP = 'GBP';
    case JPY = 'JPY';

    public function isEUR(): bool
    {
        return $this === self::EUR;
    }
}
