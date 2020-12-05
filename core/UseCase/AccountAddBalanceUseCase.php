<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Repository\AccountRepositoryInterface;

class AccountAddBalanceUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle($id, $amount): ?int
    {
        $account = $this->accountRepository->find($id);

        if(empty($account)) {
            return null;
        }

        return $this->accountRepository->update($account, [
            'balance' => $account->get('balance') + $amount
        ]);
    }
}