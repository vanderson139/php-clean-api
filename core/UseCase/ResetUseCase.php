<?php declare(strict_types = 1);

namespace Core\UseCase;

use Core\Adapter\Repository\ResetRepositoryInterface;

class ResetUseCase
{
    protected $resetRepository;

    public function __construct(ResetRepositoryInterface $resetRepository)
    {
        $this->resetRepository = $resetRepository;
    }

    public function execute()
    {
        $this->resetRepository->drop();
    }
}