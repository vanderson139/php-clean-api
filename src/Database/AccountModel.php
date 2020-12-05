<?php declare(strict_types = 1);

namespace Api\Database;

use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Database\EntityInterface;

class AccountModel extends AbstractModel implements AccountEntityInterface
{

    public function getBalance(): float
    {
        return (float)$this->get('balance');
    }

    public function setBalance(float $amount): EntityInterface
    {
        $this->set('balance', $amount);
        return $this;
    }

    public function addBalance(float $amount): EntityInterface
    {
        $this->setBalance($this->getBalance() + $amount);
        return $this;
    }

    public function subBalance(float $amount): EntityInterface
    {
        $this->setBalance($this->getBalance() - $amount);
        return $this;
    }
}
