<?php

declare(strict_types=1);

namespace App\Tests\Unit\CommissionCalculator\Domain\Factory;

use App\CommissionCalculator\Domain\Enum\CurrencyEnum;
use App\CommissionCalculator\Domain\Exception\CreateTransactionException;
use App\CommissionCalculator\Domain\Factory\TransactionFactory;
use App\CommissionCalculator\Domain\ValueObject\Money;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class TransactionFactoryTest extends UnitTestCase
{
    #[Test]
    public function itShouldCreateTransaction(): void
    {
        // given
        $factory = new TransactionFactory();

        // when
        $transaction = $factory->create(
            $bin = '123456',
            $amount = 100.0,
            $currency = 'USD',
        );

        // then
        $this->assertEquals($bin, $transaction->getBin());
        $this->assertEquals(new Money($amount), $transaction->getAmount());
        $this->assertEquals(CurrencyEnum::from($currency), $transaction->getCurrency());
    }

    #[Test]
    public function itShouldThrowCreateTransactionExceptionDueToWrongCurrency(): void
    {
        // given
        $factory = new TransactionFactory();

        // then
        $this->expectException(CreateTransactionException::class);

        // when
        $factory->create(
            'test',
            1.1,
            'test',
        );
    }
}
