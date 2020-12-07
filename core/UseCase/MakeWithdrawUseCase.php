<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\EventEntityInterface;
use Core\EventHandler\CreateEventHandler;
use Core\EventHandler\MakeWithdrawEventHandler;
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
        try {
            $this->eventManager->addHandler(new MakeWithdrawEventHandler())
                ->addHandler(new CreateEventHandler())
                ->process($event);
        } catch(\InvalidArgumentException $e) {
            return null;
        }
        
        return $event;
    }
}