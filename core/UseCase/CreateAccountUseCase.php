<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Repository\AccountRepositoryInterface;

class CreateAccountUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function execute(array $data = []): ?AccountEntityInterface
    {
        $data = array_merge($data, ['balance' => 0]);
        $id = $this->accountRepository->save($data);
        return $this->accountRepository->find($id);
    }
}