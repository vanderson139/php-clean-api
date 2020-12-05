<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\Repository\EventRepositoryInterface;

class CreateEventUseCase
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function execute(string $type, float $amount, ?AccountEntityInterface $destination = null, ?AccountEntityInterface $origin = null): ?EventEntityInterface
    {
        $eventId = $this->eventRepository->save([
            'type' => $type,
            'destination' => $destination ? $destination->getId() : null,
            'origin' => $origin ? $origin->getId() : null,
            'amount' => $amount,
        ]);

        /** @var EventEntityInterface $event */
        $event = $this->eventRepository->find($eventId);
        
        $event->setOriginAccount($origin);
        $event->setDestinationAccount($destination);
        
        return $event;
    }
}