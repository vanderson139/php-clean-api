<?php declare(strict_types = 1);

namespace Api\UseCase;

use Api\Adapter\EventRepositoryInterface;
use Api\Factory\AccountFactory;

class CreateEventUseCase
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function handle($type, $destination, $amount)
    {
        $eventId = $this->eventRepository->save('events', [
            'type' => $type,
            'destination' => $destination,
            'amount' => $amount,
        ]);
        
        switch ($type) {
            default:
                $this->deposit($destination, $amount);
        }
        
        return $this->eventRepository->find('events', $eventId);
    }

    public function deposit($accountId, $amount)
    {
        return AccountFactory::updateAccount()->addBalance($accountId, $amount);
    }
}