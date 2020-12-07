<?php declare(strict_types = 1);

namespace Core\Service;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;

class EventProcessor
{

    /**
     * @var EventHandlerInterface
     */
    private $handler;

    public function addHandler(EventHandlerInterface $handler): self
    {
        if(!$this->handler) {
            $this->handler = $handler;
            return $this;
        }
        
        $lastHandler = $this->getLastHandler();
        
        $lastHandler->setNext($handler);

        return $this;
    }

    public function process(EventEntityInterface $event)
    {
        return !$this->handler ?: $this->handler->handle($event);
    }
    
    private function getLastHandler(): EventHandlerInterface
    {
        $lastHandler = $this->handler;

        while ($lastHandler->hasNext()) {
            $lastHandler = $lastHandler->getNext();
        }
        
        return $lastHandler;
    }
}