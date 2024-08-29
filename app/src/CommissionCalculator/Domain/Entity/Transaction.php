<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\Entity;

use App\CommissionCalculator\Domain\Enum\CurrencyEnum;
use App\CommissionCalculator\Domain\ValueObject\Money;

class Transaction
{
    public function __construct(
        private string $id,
        private string $bin,
        private Money $amount,
        private CurrencyEnum $currency,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBin(): string
    {
        return $this->bin;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }
}