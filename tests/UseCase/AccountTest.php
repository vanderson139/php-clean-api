<?php declare(strict_types = 1);

namespace Tests\UseCase;

use Core\UseCase\CreateAccountUseCase;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testCreateAccount()
    {
        $stub = $this->createMock(CreateAccountUseCase::class);
        $stub->method('handle')
            ->willReturn([]);
        $this->assertEquals([], $stub->handle([]));
    }
}