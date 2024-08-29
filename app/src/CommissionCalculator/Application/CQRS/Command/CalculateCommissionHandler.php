<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Application\CQRS\Command;

use App\CommissionCalculator\Application\CQRS\Event\CommissionCalculated;
use App\CommissionCalculator\Domain\Factory\TransactionFactory;
use App\CommissionCalculator\Domain\Service\CommissionCalculator;
use App\Shared\CQRS\Command\CommandHandlerInterface;
use App\Shared\CQRS\Event\EventBusInterface;

final readonly class CalculateCommissionHandler implements CommandHandlerInterface
{
    public function __construct(
        private CommissionCalculator $commissionCalculator,
        private TransactionFactory $transactionFactory,
        private EventBusInterface $eventBus,
    ) {
    }

    public function __invoke(CalculateCommission $command): void
    {
        $commissionAmount = $this->commissionCalculator->calculate(
            $this->transactionFactory->create(
                $command->bin,
                $command->amount,
                $command->currency,
            ),
        );

        $this->eventBus->dispatch(
            new CommissionCalculated($commissionAmount->value),
        );
    }
}
