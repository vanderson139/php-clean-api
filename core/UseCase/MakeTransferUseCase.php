<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\EventEntityInterface;
use Core\Service\EventHandler\CreateAccountEventHandler;
use Core\Service\EventHandler\CreateEventHandler;
use Core\Service\EventHandler\DepositEventHandler;
use Core\Service\EventHandler\WithdrawEventHandler;
use Core\Service\EventManager;

class MakeTransferUseCase
{
    protected $eventManager;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function execute(EventEntityInterface $event): ?EventEntityInterface
    {
        $this->eventManager->addHandler(new CreateAccountEventHandler())
            ->addHandler(new WithdrawEventHandler())
            ->addHandler(new DepositEventHandler())
            ->addHandler(new CreateEventHandler())
            ->process($event);
        
        return $event;
    }
}