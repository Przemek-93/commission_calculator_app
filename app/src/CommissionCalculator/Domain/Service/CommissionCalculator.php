<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\Service;

use App\CommissionCalculator\Domain\Entity\Transaction;
use App\CommissionCalculator\Domain\ValueObject\CommissionAmount;
use App\CommissionCalculator\Domain\ValueObject\Money;

final readonly class CommissionCalculator
{
    public function __construct(
        private BinCheckerProviderInterface $binCheckerProvider,
        private ExchangeRateProviderInterface $exchangeRateProvider,
    ) {
    }

    public function calculate(Transaction $transaction): Money
    {
        $transactionCurrency = $transaction->getCurrency();
        $transactionAmount = $transaction->getAmount();

        if (false === $transactionCurrency->isEUR()) {
            $exchangeRate = $this->exchangeRateProvider->getExchangeRateByCurrency($transactionCurrency);
            $transactionAmount = $transaction->getAmount()->convert($exchangeRate);
        }

        $transactionCountryCode = $this->binCheckerProvider->getCountryCodeByBin($transaction->getBin());
        $commissionAmount = new CommissionAmount(
            $transactionAmount->value,
            $transactionCountryCode,
        );

        return new Money($commissionAmount->getRoundedValue());
    }
}
