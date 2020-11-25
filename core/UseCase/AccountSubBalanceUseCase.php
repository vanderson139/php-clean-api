<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\AccountRepositoryInterface;

class AccountSubBalanceUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle($id, $amount)
    {
        $account = $this->accountRepository->find($id);

        if(empty($account->id)) {
            return [];
        }

        return $this->accountRepository->update($account, [
            'balance' => $account->balance - $amount
        ]);
    }
}