<?php declare(strict_types = 1);

namespace Api\Factory;

use Api\UseCase\CreateEventUseCase;
use Api\Repository\EventRepository;

class EventFactory
{
    public static function createEvent()
    {
        return new CreateEventUseCase(
            new EventRepository()
        );
    }
}