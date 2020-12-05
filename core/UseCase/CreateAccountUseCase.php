<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Repository\AccountRepositoryInterface;
use Core\Adapter\Database\EntityInterface;

class CreateAccountUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function execute(AccountEntityInterface $account): ?AccountEntityInterface
    {
        $id = $this->accountRepository->save($account->toArray());
        return $this->accountRepository->find($id);
    }
}