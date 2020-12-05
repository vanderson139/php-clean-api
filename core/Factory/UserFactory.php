<?php declare(strict_types = 1);

namespace Core\Factory;

use Core\Repository\EventRepository;
use Core\Repository\AccountRepository;

use Core\Service\EventManager;

use Core\UseCase\AccountAddBalanceUseCase;
use Core\UseCase\AccountSubBalanceUseCase;
use Core\UseCase\CreateAccountUseCase;
use Core\UseCase\CreateEventUseCase;
use Core\UseCase\GetAccountUseCase;
use Core\UseCase\MakeDepositUseCase;
use Core\UseCase\MakeTransferUseCase;
use Core\UseCase\MakeWithdrawUseCase;

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

    public static function makeDeposit(): MakeDepositUseCase
    {
        return new MakeDepositUseCase(
            new EventManager()
        );
    }

    public static function makeWithdraw(): MakeWithdrawUseCase
    {
        return new MakeWithdrawUseCase(
            new EventManager()
        );
    }

    public static function makeTransfer(): MakeTransferUseCase
    {
        return new MakeTransferUseCase(
            new EventManager()
        );
    }
}