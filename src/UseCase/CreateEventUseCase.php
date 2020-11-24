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
            case 'withdraw':
                $this->withdraw($destination, $amount);
                break;
            default:
                $this->deposit($destination, $amount);
                break;
        }
        
        return $this->eventRepository->find('events', $eventId);
    }

    protected function deposit($accountId, $amount)
    {
        return AccountFactory::updateAccount()->addBalance($accountId, $amount);
    }

    protected function withdraw($accountId, $amount)
    {
        return AccountFactory::updateAccount()->subBalance($accountId, $amount);
    }
}