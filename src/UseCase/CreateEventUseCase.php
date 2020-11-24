<?php declare(strict_types = 1);

namespace Api\UseCase;

use Api\Adapter\EventRepositoryInterface;
use Api\Enum\EventType;
use Api\Factory\UserFactory;

class CreateEventUseCase
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function handle($type, $originId, $destinationId, $amount)
    {
        $eventId = $this->eventRepository->save([
            'type' => $type,
            'destination' => $destinationId,
            'origin' => $originId,
            'amount' => $amount,
        ]);
        
        switch ($type) {
            case EventType::WITHDRAW:
                $this->withdraw($originId, $amount);
                break;
            case EventType::TRANSFER:
                $this->transfer($originId, $destinationId, $amount);
                break;
            default:
                $this->deposit($destinationId, $amount);
                break;
        }
        
        return $this->eventRepository->find($eventId);
    }

    protected function deposit($accountId, $amount)
    {
        return UserFactory::updateAccount()->addBalance($accountId, $amount);
    }

    protected function withdraw($accountId, $amount)
    {
        return UserFactory::updateAccount()->subBalance($accountId, $amount);
    }

    protected function transfer($originId, $destinationId, $amount)
    {
        UserFactory::updateAccount()->subBalance($originId, $amount);
        UserFactory::updateAccount()->addBalance($destinationId, $amount);
    }
}