<?php declare(strict_types = 1);

namespace Core\EventHandler;

use Core\Adapter\Database\EventEntityInterface;
use Core\Adapter\EventHandlerInterface;
use Core\Factory\UserFactory;

class MakeWithdrawEventHandler extends AbstractEventHandler
{
    public function handle(EventEntityInterface $event): ?EventHandlerInterface
    {
        $account = $event->getOriginAccount();
        $amount = $event->getAmount();
        
        if(!$account) {
            $account = UserFactory::getAccount()->execute($event->getOrigin());
        }
        
        UserFactory::accountSubBalance()->execute($account, $amount);
        
        $event->setOriginAccount($account);

        return parent::handle($event);
    }
}