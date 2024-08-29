<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\Factory;

use App\CommissionCalculator\Domain\Entity\Transaction;
use App\CommissionCalculator\Domain\Enum\CurrencyEnum;
use App\CommissionCalculator\Domain\Exception\CreateTransactionException;
use App\CommissionCalculator\Domain\ValueObject\Money;
use Ramsey\Uuid\Uuid;
use Throwable;

final readonly class TransactionFactory
{
    public function create(
        string $bin,
        float $amount,
        string $currency,
    ): Transaction {
        try {
            return new Transaction(
                Uuid::uuid4()->toString(),
                $bin,
                new Money($amount),
                CurrencyEnum::from($currency),
            );
        } catch (Throwable $throwable) {
            throw new CreateTransactionException($throwable);
        }
    }
}
