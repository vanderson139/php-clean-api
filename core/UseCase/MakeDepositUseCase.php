<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\EventEntityInterface;
use Core\EventHandler\CreateDestinationAccountEventHandler;
use Core\EventHandler\CreateEventHandler;
use Core\EventHandler\MakeDepositEventHandler;
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
        $this->eventManager->addHandler(new CreateDestinationAccountEventHandler())
            ->addHandler(new MakeDepositEventHandler())
            ->addHandler(new CreateEventHandler())
            ->process($event);
        
        return $event;
    }
}