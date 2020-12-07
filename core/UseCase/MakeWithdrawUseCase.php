<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\EventEntityInterface;
use Core\EventHandler\CreateEventHandler;
use Core\EventHandler\WithdrawEventHandler;
use Core\Service\EventProcessor;

class MakeWithdrawUseCase
{
    protected $eventManager;

    public function __construct(EventProcessor $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function execute(EventEntityInterface $event): ?EventEntityInterface
    {
        $this->eventManager->addHandler(new WithdrawEventHandler())
            ->addHandler(new CreateEventHandler())
            ->process($event);
        
        return $event;
    }
}