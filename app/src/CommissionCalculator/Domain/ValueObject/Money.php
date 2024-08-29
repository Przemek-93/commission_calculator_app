<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\ValueObject;

final readonly class Money
{
    public function __construct(
        public float $value,
    ) {
    }

    public function convert(float $rate): Money
    {
        return new Money($this->value / $rate);
    }
}