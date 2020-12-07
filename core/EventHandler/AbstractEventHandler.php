<?php declare(strict_types = 1);

namespace Core\EventHandler;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;

abstract class AbstractEventHandler implements EventHandlerInterface
{
    private $nextHandler;

    public function setNext(EventHandlerInterface $handler): ?EventHandlerInterface
    {
        $this->nextHandler = $handler;
        return $handler;
    }
    
    public function hasNext(): bool
    {
        return isset($this->nextHandler);
    }

    public function getNext(): ?EventHandlerInterface
    {
        return $this->nextHandler;
    }

    public function handle(EventEntityInterface $event): ?EventHandlerInterface
    {
        if ($this->hasNext()) {
            return $this->getNext()->handle($event);
        }

        return null;
    }
}