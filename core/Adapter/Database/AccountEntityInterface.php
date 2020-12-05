<?php declare(strict_types = 1);

namespace Core\Adapter\Database;

interface AccountEntityInterface extends EntityInterface
{
    public function getBalance(): float;
    public function setBalance(float $amount): EntityInterface;
    public function addBalance(float $amount): EntityInterface;
    public function subBalance(float $amount): EntityInterface;
}
