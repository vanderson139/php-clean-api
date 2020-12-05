<?php declare(strict_types = 1);

namespace Core\Factory;

use Core\Adapter\Database\ConnectionInterface;
use Core\Repository\EventRepository;
use Core\Repository\AccountRepository;

use Core\UseCase\AccountAddBalanceUseCase;
use Core\UseCase\AccountSubBalanceUseCase;
use Core\UseCase\CreateAccountUseCase;
use Core\UseCase\CreateDepositEventUseCase;
use Core\UseCase\CreateEventUseCase;
use Core\UseCase\GetAccountUseCase;
use GuzzleHttp\Promise\Create;

class UserFactory
{
    public static function getAccount(): GetAccountUseCase
    {
        return new GetAccountUseCase(
            new AccountRepository()
        );
    }

    public static function createAccount(): CreateAccountUseCase
    {
        return new CreateAccountUseCase(
            new AccountRepository()
        );
    }

    public static function accountAddBalance(): AccountAddBalanceUseCase
    {
        return new AccountAddBalanceUseCase(
            new AccountRepository()
        );
    }

    public static function accountSubBalance(): AccountSubBalanceUseCase
    {
        return new AccountSubBalanceUseCase(
            new AccountRepository()
        );
    }

    public static function createEvent(): CreateEventUseCase
    {
        return new CreateEventUseCase(
            new EventRepository()
        );
    }

    public static function createDepositEvent(): CreateDepositEventUseCase
    {
        return new CreateDepositEventUseCase(
            new EventRepository()
        );
    }
}