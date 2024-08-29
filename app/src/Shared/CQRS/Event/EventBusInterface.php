<?php

declare(strict_types=1);

namespace App\Shared\CQRS\Event;

interface EventBusInterface
{
    public function dispatch(EventInterface $event): void;
}
