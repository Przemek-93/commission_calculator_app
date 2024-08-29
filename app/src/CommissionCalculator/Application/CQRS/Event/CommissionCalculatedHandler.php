<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Application\CQRS\Event;

use App\Shared\CQRS\Event\EventHandlerInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;

final readonly class CommissionCalculatedHandler implements EventHandlerInterface
{
    public function __construct(
        private ConsoleOutputInterface $consoleOutput,
    ) {
    }

    public function __invoke(CommissionCalculated $event): void
    {
        $this->consoleOutput->writeln((string) $event->commissionAmount);
    }
}
