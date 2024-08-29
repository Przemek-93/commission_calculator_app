<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\CQRS\Event;

use App\Shared\CQRS\Event\EventBusInterface;
use App\Shared\CQRS\Event\EventInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class EventBus implements EventBusInterface
{
    public function __construct(
        private MessageBusInterface $bus,
    ) {
    }

    public function dispatch(EventInterface $event): void
    {
        $this->bus->dispatch($event);
    }
}
