<?php declare(strict_types = 1);

namespace Api\Factory;

use Api\UseCase\CreateAccountUseCase;
use Api\UseCase\GetAccountUseCase;
use Api\Repository\AccountRepository;
use Api\UseCase\UpdateAccountUseCase;

class AccountFactory
{
    public static function getAccount()
    {
        return new GetAccountUseCase(
            new AccountRepository()
        );
    }

    public static function createAccount()
    {
        return new CreateAccountUseCase(
            new AccountRepository()
        );
    }

    public static function updateAccount()
    {
        return new UpdateAccountUseCase(
            new AccountRepository()
        );
    }
}