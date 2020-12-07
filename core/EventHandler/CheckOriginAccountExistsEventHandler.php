<?php declare(strict_types = 1);

namespace Core\EventHandler;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;
use Core\Factory\UserFactory;

class CheckOriginAccountExistsEventHandler extends AbstractEventHandler
{
    public function handle(EventEntityInterface $event): ?EventHandlerInterface
    {
        if($event->getOrigin()) {
            $account = UserFactory::getAccount()->execute($event->getOrigin());

            if(!$account) {
                throw new \InvalidArgumentException("Origin account not found!");
            }

            $event->setOriginAccount($account);
        }

        return parent::handle($event);
    }
}