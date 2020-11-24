<?php declare(strict_types = 1);

namespace Api\UseCase;

use Api\Adapter\AccountRepositoryInterface;

class CreateAccountUseCase
{
    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle($data)
    {
        $accountId = $this->accountRepository->save('accounts', $data);
        return $this->accountRepository->find('accounts', $accountId);
    }
}