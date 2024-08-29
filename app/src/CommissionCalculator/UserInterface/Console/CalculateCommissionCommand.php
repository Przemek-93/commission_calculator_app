<?php

declare(strict_types=1);

namespace App\CommissionCalculator\UserInterface\Console;

use App\CommissionCalculator\Application\CQRS\Command\CalculateCommission;
use App\Shared\CQRS\Command\CommandBusInterface;
use InvalidArgumentException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'commission:calculate',
    description: 'Calculate commission by given input filename.',
)]
final class CalculateCommissionCommand extends Command
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument(
            'input',
            InputArgument::REQUIRED,
            'The name of the input file (without extensions)',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $output->writeln('Calculating commission: start');

            $explodedInput = explode(
                "\n",
                file_get_contents(
                    sprintf('%s/../../../../files/%s.txt', __DIR__, $input->getArgument('input')),
                ),
            );

            foreach ($explodedInput as $row) {
                if (false === json_validate($row)) {
                    throw new InvalidArgumentException('Invalid json input!');
                }

                $data = json_decode($row, true, 512, JSON_THROW_ON_ERROR);

                $this->commandBus->dispatch(
                    new CalculateCommission(
                        $data['bin'],
                        (float) $data['amount'],
                        $data['currency'],
                    ),
                );
            }

            $output->writeln('<info>Calculating commission: success</info>');

            return Command::SUCCESS;
        } catch (Throwable $throwable) {
            $output->writeln(
                sprintf(
                    '<error>Calculating commission error: "%s"</error>',
                    $throwable->getMessage()
                )
            );

            return Command::FAILURE;
        }
    }
}
