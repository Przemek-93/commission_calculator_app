<?php

declare(strict_types=1);

namespace App\Tests\Unit\CommissionCalculator\Domain\ValueObject;

use App\CommissionCalculator\Domain\ValueObject\CommissionAmount;
use App\CommissionCalculator\Infrastructure\Enum\CountryCodeEnum;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class CommissionAmountTest extends UnitTestCase
{
    #[Test]
    public function itShouldDifferentCalculateAmountForEUandNotEUCountries(): void
    {
        //  given
        $float = 123.45;
        $euCountryEnum = CountryCodeEnum::PL;
        $notEuCountryEnum = CountryCodeEnum::AF;

        // when
        $euCommissionAmount = new CommissionAmount($float, $euCountryEnum);
        $notEuCommissionAmount = new CommissionAmount($float, $notEuCountryEnum);

        // then
        $this->assertTrue($euCountryEnum->isEurope());
        $this->assertFalse($notEuCountryEnum->isEurope());
        $this->assertGreaterThan($euCommissionAmount->value, $notEuCommissionAmount->value);
    }

    #[Test]
    public function itShouldRoundValue(): void
    {
        //  given
        $float = 1.55454;
        $euCountryEnum = CountryCodeEnum::PL;

        // when
        $commissionAmount = new CommissionAmount($float, $euCountryEnum);

        // then
        $countDecimalPlaces = $this->countDecimalPlaces($commissionAmount->value);
        $this->assertGreaterThan(2, $countDecimalPlaces);

        $countDecimalPlacesAfterRound = $this->countDecimalPlaces($commissionAmount->getRoundedValue());
        $this->assertLessThanOrEqual(2, $countDecimalPlacesAfterRound);
    }

    private function countDecimalPlaces(float $value): int
    {
        return strlen(
            rtrim(explode('.', (string) $value)[1] ?? '',
                '0',
            ),
        );
    }
}
