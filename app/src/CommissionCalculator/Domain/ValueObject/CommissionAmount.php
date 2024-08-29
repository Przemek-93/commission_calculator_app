<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\ValueObject;

use App\CommissionCalculator\Infrastructure\Enum\CountryCodeEnum;

final readonly class CommissionAmount
{
    public float $value;

    public function __construct(
        float $transactionAmount,
        CountryCodeEnum $countryCode,
    ) {
        $rate = $countryCode->isEurope() ? 0.01 : 0.02;
        $this->value = $transactionAmount * $rate;
    }

    public function getRoundedValue(): float
    {
        return round($this->value, 2);
    }
}