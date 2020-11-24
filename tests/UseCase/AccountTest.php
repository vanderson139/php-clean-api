<?php declare(strict_types = 1);

namespace Tests\UseCase;

use Api\Factory\AccountFactory;
use Api\UseCase\CreateAccountUseCase;
use PHPUnit\Framework\TestCase;
use RedBeanPHP\R;

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