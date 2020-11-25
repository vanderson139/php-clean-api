<?php declare(strict_types = 1);

namespace Core\Factory;

use Core\Repository\EventRepository;
use Core\Repository\AccountRepository;

use Api\UseCase\CreateAccountUseCase;
use Api\UseCase\CreateEventUseCase;
use Api\UseCase\GetAccountUseCase;
use Api\UseCase\UpdateAccountUseCase;

class UserFactory
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

    public static function createEvent()
    {
        return new CreateEventUseCase(
            new EventRepository()
        );
    }
}