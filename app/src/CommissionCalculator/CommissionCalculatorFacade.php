<?php

declare(strict_types=1);

namespace App\CommissionCalculator;

use App\CommissionCalculator\Application\CQRS\Command\CalculateCommission;
use App\Shared\CQRS\CommandBusInterface;
use App\Shared\Serializer\SerializerInterface;

final readonly class CommissionCalculatorFacade
{
    public function __construct(
        private CommandBusInterface $commandBus,
        private SerializerInterface $serializer,
    ) {
    }

    public function notify(string $input): void
    {
        $this->commandBus->dispatch(
            $this->serializer->deserialize($input, CalculateCommission::class),
        );
    }
}
