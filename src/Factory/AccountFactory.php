<?php declare(strict_types = 1);

namespace Api\Factory;

use Api\UseCase\GetAccountUseCase;
use Api\Repository\AccountRepository;

class AccountFactory
{
    public static function getAccount()
    {
        return new GetAccountUseCase(
            new AccountRepository()
        );
    }
}