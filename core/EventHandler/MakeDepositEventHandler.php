<?php declare(strict_types = 1);

namespace Core\EventHandler;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;
use Core\Factory\UserFactory;

class MakeDepositEventHandler extends AbstractEventHandler
{
    public function handle(EventEntityInterface $event): ?EventHandlerInterface
    {
        $account = $event->getDestinationAccount();
        $amount = $event->getAmount();

        UserFactory::accountAddBalance()->execute($account, $amount);
        
        return parent::handle($event);
    }
}