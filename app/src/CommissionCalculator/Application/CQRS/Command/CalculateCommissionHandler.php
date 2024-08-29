<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Application\CQRS\Command;

use App\Shared\CQRS\CommandHandlerInterface;

final readonly class CalculateCommissionHandler implements CommandHandlerInterface
{
    public function __construct(
    ) {
    }

    public function __invoke(CalculateCommission $command): void
    {
    }
}
