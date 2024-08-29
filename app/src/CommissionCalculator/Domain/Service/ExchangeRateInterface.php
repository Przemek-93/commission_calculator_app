<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\Service;

use App\CommissionCalculator\Domain\Enum\CurrencyEnum;

interface ExchangeRateInterface
{
    public function getExchangeRateByCurrency(CurrencyEnum $currencyEnum): float;
}
