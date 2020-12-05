<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\AccountRepositoryInterface;
use Core\Adapter\Database\EntityInterface;

class GetAccountUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle($id): ?EntityInterface
    {
        $account = $this->accountRepository->find($id);

        if(empty($account)) {
            return null;
        }
        
        return $account;
    }
}