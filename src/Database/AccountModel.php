<?php declare(strict_types = 1);

namespace Api\Database;

use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Database\EntityInterface;

class AccountModel extends AbstractModel implements AccountEntityInterface
{

    public function getBalance(): float
    {
        // TODO: Implement getBalance() method.
    }

    public function setBalance(float $amount): EntityInterface
    {
        // TODO: Implement setBalance() method.
    }

    public function addBalance(float $amount): EntityInterface
    {
        // TODO: Implement addBalance() method.
    }

    public function subBalance(float $amount): EntityInterface
    {
        // TODO: Implement subBalance() method.
    }
}
