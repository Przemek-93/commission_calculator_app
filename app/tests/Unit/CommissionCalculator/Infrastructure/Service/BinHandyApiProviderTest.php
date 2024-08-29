<?php

declare(strict_types=1);

namespace App\Tests\Unit\CommissionCalculator\Infrastructure\Service;

use App\CommissionCalculator\Infrastructure\Exception\ExternalIntegrationException;
use App\CommissionCalculator\Infrastructure\Service\BinHandyApiProvider;
use App\Tests\Unit\UnitTestCase;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class BinHandyApiProviderTest extends UnitTestCase
{
    #[Test]
    public function itShouldGetCountryCodeSuccessfully(): void
    {
        // given
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock
            ->expects($this->once())
            ->method('toArray')
            ->willReturn(['Country' => ['A2' => 'PL']]);

        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->willReturn($responseMock);

        // when
        $provider = new BinHandyApiProvider($httpClientMock);
        $result = $provider->getCountryCodeByBin('test');

        // then
        $this->assertTrue($result->isEurope());
    }

    #[Test]
    public function itShouldThrowExternalIntegrationExceptionDueToWrongResponse(): void
    {
        // given
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock
            ->expects($this->once())
            ->method('toArray')
            ->willReturn(['Country' => ['A2' => 'test']]);

        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->willReturn($responseMock);

        // then
        $this->expectException(ExternalIntegrationException::class);

        // when
        $provider = new BinHandyApiProvider($httpClientMock);
        $provider->getCountryCodeByBin('test');
    }

    #[Test]
    public function itShouldThrowExternalIntegrationExceptionDueToRequestError(): void
    {
        // given
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('request')
            ->willThrowException(new Exception('test'));

        // then
        $this->expectException(ExternalIntegrationException::class);

        // when
        $provider = new BinHandyApiProvider($httpClientMock);
        $provider->getCountryCodeByBin('test');
    }
}
