<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Repository\AccountRepositoryInterface;
use Core\Adapter\Database\EntityInterface;

class CreateAccountUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle($data): ?EntityInterface
    {
        $id = $this->accountRepository->save($data);
        return $this->accountRepository->find($id);
    }
}