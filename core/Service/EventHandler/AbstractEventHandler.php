<?php declare(strict_types = 1);

namespace Core\Service\EventHandler;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;

abstract class AbstractEventHandler implements EventHandlerInterface
{
    private $nextHandler;

    public function setNext(EventHandlerInterface $handler):? EventHandlerInterface
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(EventEntityInterface $event):? EventHandlerInterface
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($event);
        }

        return null;
    }
}