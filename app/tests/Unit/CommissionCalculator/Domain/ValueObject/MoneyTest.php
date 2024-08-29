<?php

declare(strict_types=1);

namespace App\Tests\Unit\CommissionCalculator\Domain\ValueObject;

use App\CommissionCalculator\Domain\ValueObject\Money;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class MoneyTest extends UnitTestCase
{
    #[Test]
    public function itShouldConvertSuccessfully(): void
    {
        //  given
        $value = 123.45;
        $rate = 0.3;

        // when
        $money = new Money($value);

        // then
        $this->assertEquals($value / $rate, $money->convert($rate)->value);
    }
}
