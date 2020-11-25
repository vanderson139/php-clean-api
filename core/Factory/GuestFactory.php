<?php declare(strict_types = 1);

namespace Core\Factory;

use Api\Repository\ResetRepository;
use Api\UseCase\ResetUseCase;

class GuestFactory
{
    public static function dropDatabase()
    {
        return new ResetUseCase(
            new ResetRepository()
        );
    }
}