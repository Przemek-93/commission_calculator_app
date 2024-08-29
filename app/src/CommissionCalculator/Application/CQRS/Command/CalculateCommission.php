<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Application\CQRS\Command;

use App\Shared\CQRS\Command\CommandInterface;

final readonly class CalculateCommission implements CommandInterface
{
    public function __construct(
        public string $bin,
        public float $amount,
        public string $currency,
    ) {
    }
}
