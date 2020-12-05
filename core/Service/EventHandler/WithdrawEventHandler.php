<?php declare(strict_types = 1);

namespace Core\Service\EventHandler;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;
use Core\Factory\UserFactory;

class WithdrawEventHandler extends AbstractEventHandler
{
    public function handle(EventEntityInterface $event):? EventHandlerInterface
    {
        $account = $event->getOriginAccount();
        $amount = $event->getAmount();
        
        UserFactory::accountSubBalance()->execute($account, $amount);

        return parent::handle($event);
    }
}