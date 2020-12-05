<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Repository\AccountRepositoryInterface;

class AccountAddBalanceUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle(AccountEntityInterface $account, float $amount): bool
    {
        $account->addBalance($amount);

        return (bool)$this->accountRepository->update($account);
    }
}