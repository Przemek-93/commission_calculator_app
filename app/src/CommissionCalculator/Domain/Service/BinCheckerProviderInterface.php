<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\Service;

use App\CommissionCalculator\Infrastructure\Enum\CountryCodeEnum;

interface BinCheckerProviderInterface
{
    public function getCountryCodeByBin(string $bin): CountryCodeEnum;
}
