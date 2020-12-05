<?php declare(strict_types = 1);

namespace Core\Service;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;

class EventManager
{

    /**
     * @var EventHandlerInterface 
     */
    private $handler;

    public function addHandler(EventHandlerInterface $handler): self
    {
        if(!$this->handler) {
            $this->handler = $handler;
        } else {
            $this->handler->setNext($handler);
        }

        return $this;
    }

    public function process(EventEntityInterface $event)
    {
        return !$this->handler ?: $this->handler->handle($event);
    }
}