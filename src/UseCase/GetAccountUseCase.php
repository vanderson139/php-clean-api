<?php declare(strict_types = 1);

namespace Api\UseCase;

use Api\Adapter\RepositoryInterface;

class GetAccountUseCase
{
    protected $accountRepository;

    public function __construct(RepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function handle($id)
    {
        return $this->accountRepository->find($id);
    }
}