<?php

declare(strict_types=1);

namespace App\Tests\Unit\CommissionCalculator\Infrastructure\Service;

use App\CommissionCalculator\Domain\Enum\CurrencyEnum;
use App\CommissionCalculator\Infrastructure\Exception\ExternalIntegrationException;
use App\CommissionCalculator\Infrastructure\Service\ExchangeRateFrankfurterProvider;
use App\Tests\Unit\UnitTestCase;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ExchangeRateFrankfurterProviderTest extends UnitTestCase
{
    #[Test]
    public function itShouldGetExchangeRateByCurrencySuccessfully(): void
    {
        // given
        $currency = CurrencyEnum::EUR;
        $float = 1.1;
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock
            ->expects($this->once())
            ->method('toArray')
            ->willReturn(['rates' => [$currency->value => $float]]);

        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->willReturn($responseMock);

        // when
        $provider = new ExchangeRateFrankfurterProvider($httpClientMock);
        $result = $provider->getExchangeRateByCurrency($currency);

        // then
        $this->assertEquals($float, $result);
    }

    #[Test]
    public function itShouldReturnDefaultFloatDueToWrongResponse(): void
    {
        // given
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock
            ->expects($this->once())
            ->method('toArray')
            ->willReturn(['rates' => [CurrencyEnum::GBP->value => 1.1]]);

        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->willReturn($responseMock);

        // when
        $provider = new ExchangeRateFrankfurterProvider($httpClientMock);
        $result = $provider->getExchangeRateByCurrency(CurrencyEnum::EUR);

        // then
        $this->assertEquals(0.0, $result);
    }

    #[Test]
    public function itShouldThrowExceptionDueToResponseError(): void
    {
        // given
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock
            ->expects($this->once())
            ->method('toArray')
            ->willThrowException(new Exception('test'));

        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->willReturn($responseMock);

        // then
        $this->expectException(ExternalIntegrationException::class);

        // when
        $provider = new ExchangeRateFrankfurterProvider($httpClientMock);
        $provider->getExchangeRateByCurrency(CurrencyEnum::EUR);
    }
}
