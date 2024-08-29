<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Application\CQRS\Command;

use App\Shared\CQRS\CommandInterface;

final readonly class CalculateCommission implements CommandInterface
{
    public function __construct(
    ) {
    }
}
