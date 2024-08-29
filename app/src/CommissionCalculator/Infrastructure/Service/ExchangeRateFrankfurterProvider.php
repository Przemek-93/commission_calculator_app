<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Infrastructure\Service;

use App\CommissionCalculator\Domain\Enum\CurrencyEnum;
use App\CommissionCalculator\Domain\Service\ExchangeRateProviderInterface;
use App\CommissionCalculator\Infrastructure\Exception\ExternalIntegrationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

final readonly class ExchangeRateFrankfurterProvider implements ExchangeRateProviderInterface
{
    private const string URL = 'https://www.frankfurter.app/latest';

    public function __construct(
        private HttpClientInterface $httpClient,
    ) {
    }

    public function getExchangeRateByCurrency(CurrencyEnum $currencyEnum): float
    {
        try {
            $request = $this->httpClient->request(
                Request::METHOD_GET,
                self::URL,
            );
            $response = $request->toArray();

            return $response['rates'][$currencyEnum->value] ?? 0.0;
        } catch (Throwable $throwable) {
            throw new ExternalIntegrationException(self::URL, $throwable);
        }
    }
}
