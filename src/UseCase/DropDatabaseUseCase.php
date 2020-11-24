<?php declare(strict_types = 1);

namespace Api\UseCase;

use Api\Adapter\EventRepositoryInterface;
use Api\Adapter\ResetRepositoryInterface;

class DropDatabaseUseCase
{
    protected $resetRepository;

    public function __construct(ResetRepositoryInterface $resetRepository)
    {
        $this->resetRepository = $resetRepository;
    }

    public function handle()
    {
        return $this->resetRepository->drop();
    }
}