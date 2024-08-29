<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Domain\Exception;

use DomainException;
use Throwable;

class CreateTransactionException extends DomainException
{
    public const string MESSAGE = 'Cannot create transaction, error: "%s"';

    public function __construct(
        Throwable $previous
    ) {
        parent::__construct(
            sprintf(self::MESSAGE, $previous->getMessage()),
            previous: $previous,
        );
    }
}
