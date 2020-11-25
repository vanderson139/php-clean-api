<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\AccountRepositoryInterface;

class CreateAccountUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle($data)
    {
        $id = $this->accountRepository->save($data);
        return $this->accountRepository->find($id);
    }
}