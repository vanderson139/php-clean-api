<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Repository\AccountRepositoryInterface;

class AccountSubBalanceUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle(AccountEntityInterface $account, float $amount): bool
    {
        $account->subBalance($amount);

        return (bool)$this->accountRepository->update($account);
    }
}