<?php declare(strict_types = 1);

namespace Api\Factory;

use Api\Repository\ResetRepository;
use Api\UseCase\ResetUseCase;

class ResetFactory
{
    public static function dropDatabase()
    {
        return new ResetUseCase(
            new ResetRepository()
        );
    }
}