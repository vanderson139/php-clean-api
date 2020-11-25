<?php declare(strict_types = 1);

namespace Api\Repository;

use Core\Adapter\AccountRepositoryInterface;

class AccountRepository extends AbstractRepository implements AccountRepositoryInterface
{
    protected $table = 'accounts';
}