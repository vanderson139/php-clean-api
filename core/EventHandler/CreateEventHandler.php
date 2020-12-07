<?php declare(strict_types = 1);

namespace Core\EventHandler;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;
use Core\Factory\UserFactory;

class CreateEventHandler extends AbstractEventHandler
{
    public function handle(EventEntityInterface $event): ?EventHandlerInterface
    {
        UserFactory::createEvent()->execute($event);

        return parent::handle($event);
    }
}