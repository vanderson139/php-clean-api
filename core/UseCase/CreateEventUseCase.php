<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\EntityInterface;
use Core\Adapter\Repository\EventRepositoryInterface;
use Api\Enum\EventType;
use Core\Factory\UserFactory;

class CreateEventUseCase
{
    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function handle($type, $originId, $destinationId, $amount): ?EntityInterface
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
        return UserFactory::accountAddBalance()->handle($accountId, $amount);
    }

    protected function withdraw($accountId, $amount)
    {
        return UserFactory::accountSubBalance()->handle($accountId, $amount);
    }

    protected function transfer($originId, $destinationId, $amount)
    {
        UserFactory::accountSubBalance()->handle($originId, $amount);
        UserFactory::accountAddBalance()->handle($destinationId, $amount);
    }
}