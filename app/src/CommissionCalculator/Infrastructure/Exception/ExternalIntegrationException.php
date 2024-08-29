<?php

declare(strict_types=1);

namespace App\CommissionCalculator\Infrastructure\Exception;

use Exception;
use Throwable;

class ExternalIntegrationException extends Exception
{
    public const string MESSAGE = 'Something went wrong in integration with "%s". Error: %s';

    public function __construct(
        string $from,
        Throwable $previous,
    ) {
        parent::__construct(
            sprintf(self::MESSAGE, $from, $previous->getMessage()),
            previous: $previous,
        );
    }
}