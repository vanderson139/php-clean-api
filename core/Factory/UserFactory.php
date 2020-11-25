<?php declare(strict_types = 1);

namespace Core\Factory;

use Core\Repository\EventRepository;
use Core\Repository\AccountRepository;

use Core\UseCase\CreateAccountUseCase;
use Core\UseCase\CreateEventUseCase;
use Core\UseCase\GetAccountUseCase;
use Core\UseCase\UpdateAccountUseCase;

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