<?php

declare(strict_types=1);

namespace App\Tests\Integration\CommissionCalculator;

use App\CommissionCalculator\Domain\Service\BinCheckerProviderInterface;
use App\CommissionCalculator\Domain\Service\ExchangeRateProviderInterface;
use App\CommissionCalculator\Infrastructure\Enum\CountryCodeEnum;
use App\CommissionCalculator\UserInterface\Console\CalculateCommissionCommand;
use App\Tests\Integration\IntegrationTestCase;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Tester\CommandTester;

class CalculateCommissionTest extends IntegrationTestCase
{
    #[Test]
    public function itShouldCalculateCommission(): void
    {
        // given
        $binCheckerProviderMock = $this->createMock(BinCheckerProviderInterface::class);
        $binCheckerProviderMock
            ->expects($this->atLeastOnce())
            ->method('getCountryCodeByBin')
            ->willReturn(CountryCodeEnum::PL);

        $exchangeRateProviderMock = $this->createMock(ExchangeRateProviderInterface::class);
        $exchangeRateProviderMock
            ->expects($this->atLeastOnce())
            ->method('getExchangeRateByCurrency')
            ->willReturn(1.1);

        $consoleOutputMock = $this->createMock(ConsoleOutputInterface::class);
        $consoleOutputMock
            ->expects($this->atLeastOnce())
            ->method('writeln');

        $this->getContainer()->set(BinCheckerProviderInterface::class, $binCheckerProviderMock);
        $this->getContainer()->set(ExchangeRateProviderInterface::class, $exchangeRateProviderMock);
        $this->getContainer()->set(ConsoleOutputInterface::class, $consoleOutputMock);

        $commandTester = new CommandTester($this->getContainer()->get(CalculateCommissionCommand::class));

        // when
        $commandTester->execute([]);

        // then
        $this->assertStringContainsString('Calculating commission: success', $commandTester->getDisplay());
        $this->assertEquals(Command::SUCCESS, $commandTester->getStatusCode());
    }

    #[Test]
    public function binCheckerProviderShouldThrowException(): void
    {
        // given
        $binCheckerProviderMock = $this->createMock(BinCheckerProviderInterface::class);
        $binCheckerProviderMock
            ->expects($this->once())
            ->method('getCountryCodeByBin')
            ->willThrowException(new Exception($exceptionMessage = 'test exception'));

        $exchangeRateProviderMock = $this->createMock(ExchangeRateProviderInterface::class);
        $exchangeRateProviderMock
            ->expects($this->never())
            ->method('getExchangeRateByCurrency');

        $consoleOutputMock = $this->createMock(ConsoleOutputInterface::class);
        $consoleOutputMock
            ->expects($this->never())
            ->method('writeln');

        $this->getContainer()->set(BinCheckerProviderInterface::class, $binCheckerProviderMock);
        $this->getContainer()->set(ExchangeRateProviderInterface::class, $exchangeRateProviderMock);
        $this->getContainer()->set(ConsoleOutputInterface::class, $consoleOutputMock);

        $commandTester = new CommandTester($this->getContainer()->get(CalculateCommissionCommand::class));

        // when
        $commandTester->execute([]);

        // then
        $this->assertStringContainsString($exceptionMessage, $commandTester->getDisplay());
        $this->assertStringContainsString('Calculating commission: start', $commandTester->getDisplay());
        $this->assertStringContainsString('Calculating commission error', $commandTester->getDisplay());
        $this->assertEquals(Command::FAILURE, $commandTester->getStatusCode());
    }

    #[Test]
    public function exchangeRateProviderShouldThrowException(): void
    {
        // given
        $binCheckerProviderMock = $this->createMock(BinCheckerProviderInterface::class);
        $binCheckerProviderMock
            ->expects($this->atLeastOnce())
            ->method('getCountryCodeByBin')
            ->willReturn(CountryCodeEnum::PL);

        $exchangeRateProviderMock = $this->createMock(ExchangeRateProviderInterface::class);
        $exchangeRateProviderMock
            ->expects($this->once())
            ->method('getExchangeRateByCurrency')
            ->willThrowException(new Exception($exceptionMessage = 'test exception'));

        $consoleOutputMock = $this->createMock(ConsoleOutputInterface::class);
        $consoleOutputMock
            ->expects($this->atLeastOnce())
            ->method('writeln');

        $this->getContainer()->set(BinCheckerProviderInterface::class, $binCheckerProviderMock);
        $this->getContainer()->set(ExchangeRateProviderInterface::class, $exchangeRateProviderMock);
        $this->getContainer()->set(ConsoleOutputInterface::class, $consoleOutputMock);

        $commandTester = new CommandTester($this->getContainer()->get(CalculateCommissionCommand::class));

        // when
        $commandTester->execute([]);

        // then
        $this->assertStringContainsString($exceptionMessage, $commandTester->getDisplay());
        $this->assertStringContainsString('Calculating commission: start', $commandTester->getDisplay());
        $this->assertStringContainsString('Calculating commission error', $commandTester->getDisplay());
        $this->assertEquals(Command::FAILURE, $commandTester->getStatusCode());
    }
}
