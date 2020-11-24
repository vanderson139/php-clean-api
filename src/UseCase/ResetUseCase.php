<?php declare(strict_types = 1);

namespace Api\UseCase;

use Api\Adapter\ResetRepositoryInterface;

class ResetUseCase
{
    protected $resetRepository;

    public function __construct(ResetRepositoryInterface $resetRepository)
    {
        $this->resetRepository = $resetRepository;
    }

    public function handle()
    {
        $this->resetRepository->drop();
    }
}