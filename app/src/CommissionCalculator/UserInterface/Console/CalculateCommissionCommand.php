<?php

declare(strict_types=1);

namespace App\CommissionCalculator\UserInterface\Console;

use App\CommissionCalculator\Application\CQRS\Command\CalculateCommission;
use App\Shared\CQRS\CommandBusInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'commission:calculate',
    description: 'Test command for send notifications to users',
)]
final class CalculateCommissionCommand extends Command
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $output->writeln('Calculating commission: start');

            $this->commandBus->dispatch(
                new CalculateCommission(),
            );

            return Command::SUCCESS;
        } catch (Throwable $throwable) {
            $output->writeln(sprintf('Calculating commission error: "%s"', $throwable->getMessage()));

            return Command::FAILURE;
        }
    }
}
