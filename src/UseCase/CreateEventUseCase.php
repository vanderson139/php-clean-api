<?php declare(strict_types = 1);

namespace Api\UseCase;

use Api\Adapter\EventRepositoryInterface;

class CreateEventUseCase
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function handle($data)
    {
        $eventId = $this->eventRepository->save('events', $data);
        return $this->eventRepository->find('events', $eventId);
    }
}