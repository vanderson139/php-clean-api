<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\EventEntityInterface;
use Core\EventHandler\CreateAccountEventHandler;
use Core\EventHandler\CreateEventHandler;
use Core\EventHandler\DepositEventHandler;
use Core\Service\EventProcessor;

class MakeDepositUseCase
{
    protected $eventManager;

    public function __construct(EventProcessor $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function execute(EventEntityInterface $event): ?EventEntityInterface
    {
        $this->eventManager->addHandler(new CreateAccountEventHandler())
            ->addHandler(new DepositEventHandler())
            ->addHandler(new CreateEventHandler())
            ->process($event);
        
        return $event;
    }
}