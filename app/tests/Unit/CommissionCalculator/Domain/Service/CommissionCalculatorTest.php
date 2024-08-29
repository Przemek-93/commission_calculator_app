<?php

declare(strict_types=1);

namespace App\Tests\Unit\CommissionCalculator\Domain\Service;

use App\CommissionCalculator\Domain\Entity\Transaction;
use App\CommissionCalculator\Domain\Enum\CurrencyEnum;
use App\CommissionCalculator\Domain\Service\BinCheckerProviderInterface;
use App\CommissionCalculator\Domain\Service\CommissionCalculator;
use App\CommissionCalculator\Domain\Service\ExchangeRateProviderInterface;
use App\CommissionCalculator\Domain\ValueObject\CommissionAmount;
use App\CommissionCalculator\Domain\ValueObject\Money;
use App\CommissionCalculator\Infrastructure\Enum\CountryCodeEnum;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;
use Ramsey\Uuid\Uuid;

class CommissionCalculatorTest extends UnitTestCase
{
    #[Test]
    public function itShouldCalculateSuccessfullyForEURCurrencyAndEUCountry(): void
    {
        //  given
        $transaction = new Transaction(
            Uuid::uuid4()->toString(),
            '12345',
            new Money($amount = 144.4),
            CurrencyEnum::EUR,
        );
        $binCheckerProviderMock = $this->createMock(BinCheckerProviderInterface::class);
        $binCheckerProviderMock
            ->expects($this->once())
            ->method('getCountryCodeByBin')
            ->willReturn($countryCode = CountryCodeEnum::PL);

        $exchangeRateProviderMock = $this->createMock(ExchangeRateProviderInterface::class);
        $exchangeRateProviderMock
            ->expects($this->never())
            ->method('getExchangeRateByCurrency');

        // when
        $commissionCalculator = new CommissionCalculator(
            $binCheckerProviderMock,
            $exchangeRateProviderMock,
        );
        $result = $commissionCalculator->calculate($transaction);

        // then
        $commissionAmount = new CommissionAmount($amount, $countryCode);
        $this->assertSame($commissionAmount->getRoundedValue(), $result->value);
    }

    #[Test]
    public function itShouldCalculateSuccessfullyForNonEURCurrencyAndEUCountry(): void
    {
        //  given
        $transaction = new Transaction(
            Uuid::uuid4()->toString(),
            '12345',
            new Money($amount = 144.4),
            CurrencyEnum::GBP,
        );
        $binCheckerProviderMock = $this->createMock(BinCheckerProviderInterface::class);
        $binCheckerProviderMock
            ->expects($this->once())
            ->method('getCountryCodeByBin')
            ->willReturn($countryCode = CountryCodeEnum::PL);

        $exchangeRateProviderMock = $this->createMock(ExchangeRateProviderInterface::class);
        $exchangeRateProviderMock
            ->expects($this->once())
            ->method('getExchangeRateByCurrency')
            ->willReturn($rate = 1.1);

        // when
        $commissionCalculator = new CommissionCalculator(
            $binCheckerProviderMock,
            $exchangeRateProviderMock,
        );
        $result = $commissionCalculator->calculate($transaction);

        // then
        $commissionAmount = new CommissionAmount($amount / $rate, $countryCode);
        $this->assertSame($commissionAmount->getRoundedValue(), $result->value);
    }

    #[Test]
    public function itShouldCalculateSuccessfullyForEURCurrencyAndNonEUCountry(): void
    {
        //  given
        $transaction = new Transaction(
            Uuid::uuid4()->toString(),
            '12345',
            new Money($amount = 144.4),
            CurrencyEnum::EUR,
        );
        $binCheckerProviderMock = $this->createMock(BinCheckerProviderInterface::class);
        $binCheckerProviderMock
            ->expects($this->once())
            ->method('getCountryCodeByBin')
            ->willReturn($countryCode = CountryCodeEnum::AF);

        $exchangeRateProviderMock = $this->createMock(ExchangeRateProviderInterface::class);
        $exchangeRateProviderMock
            ->expects($this->never())
            ->method('getExchangeRateByCurrency');

        // when
        $commissionCalculator = new CommissionCalculator(
            $binCheckerProviderMock,
            $exchangeRateProviderMock,
        );
        $result = $commissionCalculator->calculate($transaction);

        // then
        $commissionAmount = new CommissionAmount($amount, $countryCode);
        $this->assertSame($commissionAmount->getRoundedValue(), $result->value);
    }

    #[Test]
    public function itShouldCalculateSuccessfullyForNonEURCurrencyAndNonEUCountry(): void
    {
        //  given
        $transaction = new Transaction(
            Uuid::uuid4()->toString(),
            '12345',
            new Money($amount = 144.4),
            CurrencyEnum::GBP,
        );
        $binCheckerProviderMock = $this->createMock(BinCheckerProviderInterface::class);
        $binCheckerProviderMock
            ->expects($this->once())
            ->method('getCountryCodeByBin')
            ->willReturn($countryCode = CountryCodeEnum::AF);

        $exchangeRateProviderMock = $this->createMock(ExchangeRateProviderInterface::class);
        $exchangeRateProviderMock
            ->expects($this->once())
            ->method('getExchangeRateByCurrency')
            ->willReturn($rate = 1.1);

        // when
        $commissionCalculator = new CommissionCalculator(
            $binCheckerProviderMock,
            $exchangeRateProviderMock,
        );
        $result = $commissionCalculator->calculate($transaction);

        // then
        $commissionAmount = new CommissionAmount($amount / $rate, $countryCode);
        $this->assertSame($commissionAmount->getRoundedValue(), $result->value);
    }
}
