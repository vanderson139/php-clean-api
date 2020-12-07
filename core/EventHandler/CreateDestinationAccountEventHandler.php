<?php declare(strict_types = 1);

namespace Core\EventHandler;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;
use Core\Factory\UserFactory;

class CreateDestinationAccountEventHandler extends AbstractEventHandler
{
    public function handle(EventEntityInterface $event): ?EventHandlerInterface
    {
        if($event->getDestination()) {
            $account = UserFactory::getAccount()->execute($event->getDestination());

            if(!$account) {
                $data = [
                    'id' => $event->getDestination(),
                ];
                $account = UserFactory::createAccount()->execute($data);
            }

            $event->setDestinationAccount($account);
        }

        return parent::handle($event);
    }
}