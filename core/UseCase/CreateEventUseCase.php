<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\Repository\EventRepositoryInterface;

class CreateEventUseCase
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function execute(EventEntityInterface $event): ?EventEntityInterface
    {
        $eventId = $this->eventRepository->save($event->toArray());

        /** @var EventEntityInterface $event */
        $event = $this->eventRepository->find($eventId);
        
        $event->setId($eventId);
        
        return $event;
    }
}