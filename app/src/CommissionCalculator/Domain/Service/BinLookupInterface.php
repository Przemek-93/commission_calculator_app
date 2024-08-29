<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\Service;

use App\CommissionCalculator\Infrastructure\Enum\CountryCodeEnum;

interface BinLookupInterface
{
    public function getCountryCodeByBin(string $bin): CountryCodeEnum;
}
