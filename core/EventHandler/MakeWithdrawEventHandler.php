<?php declare(strict_types = 1);

namespace Core\EventHandler;

use Core\Adapter\Database\AccountEntityInterface;
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
        
        if(!$this->canWithdraw($account, $amount)) {
            throw new \InvalidArgumentException('Not enough balance!');
        }
        
        UserFactory::accountSubBalance()->execute($account, $amount);
        
        $event->setOriginAccount($account);

        return parent::handle($event);
    }
    
    protected function canWithdraw(AccountEntityInterface $account, float $amount): bool
    {
        return $account->getBalance() >= $amount;
    }
}