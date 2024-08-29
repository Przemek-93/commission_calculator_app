<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Application\CQRS\Event;

use App\Shared\CQRS\Event\EventInterface;

final readonly class CommissionCalculated implements EventInterface
{
    public function __construct(
        public float $commissionAmount
    ) {
    }
}
