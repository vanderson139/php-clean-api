<?php declare(strict_types = 1);

namespace Core\Adapter;

use Core\Adapter\Database\EventEntityInterface;

interface EventHandlerInterface
{
    public function setNext(EventHandlerInterface $handler): ?EventHandlerInterface;
    
    public function hasNext(): bool;
    
    public function getNext(): ?EventHandlerInterface;

    public function handle(EventEntityInterface $event): ?EventHandlerInterface;
}