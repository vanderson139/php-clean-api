<?php declare(strict_types = 1);

namespace Core\Repository;

use Core\Adapter\Repository\AccountRepositoryInterface;

class AccountRepository extends AbstractRepository implements AccountRepositoryInterface
{
    protected $table = 'accounts';
}