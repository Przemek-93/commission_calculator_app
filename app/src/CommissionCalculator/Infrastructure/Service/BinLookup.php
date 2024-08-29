<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Infrastructure\Service;

use App\CommissionCalculator\Domain\Service\BinLookupInterface;
use App\CommissionCalculator\Infrastructure\Enum\CountryCodeEnum;
use App\CommissionCalculator\Infrastructure\Exception\ExternalIntegrationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

final readonly class BinLookup implements BinLookupInterface
{
    private const string URL = 'https://lookup.binlist.net/';

    public function __construct(
        private HttpClientInterface $httpClient,
    ) {
    }

    public function getCountryCodeByBin(string $bin): CountryCodeEnum
    {
        try {
            $request = $this->httpClient->request(
                Request::METHOD_GET,
                sprintf('%s%s', self::URL, $bin),
            );
            $response = $request->toArray();

            return CountryCodeEnum::from($response['country']['alpha2']);
        } catch (Throwable $throwable) {
            throw new ExternalIntegrationException(self::URL, $throwable);
        }
    }
}
