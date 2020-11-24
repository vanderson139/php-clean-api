<?php declare(strict_types = 1);

namespace Api\UseCase;

use Api\Adapter\AccountRepositoryInterface;

class GetAccountUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle($id)
    {
        $account = $this->accountRepository->find('accounts', $id);

        if(empty($account->id)) {
            return [];
        }
        
        return $account;
    }
}