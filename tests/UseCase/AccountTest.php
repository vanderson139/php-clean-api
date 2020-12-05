<?php declare(strict_types = 1);

namespace Tests\UseCase;

use Core\Adapter\Database\EntityInterface;
use Core\UseCase\AccountAddBalanceUseCase;
use Core\UseCase\CreateAccountUseCase;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testCreateAccount()
    {
        $data = ['balance' => 10];
        $entity = $this->createMock(EntityInterface::class);
   
        $stub = $this->createMock(CreateAccountUseCase::class);
   
        $stub->method('handle')
            ->willReturn($entity);
   
        $this->assertEquals($entity, $stub->handle($data));
    }

    public function testUpdateAccount()
    {
        $stub = $this->createMock(AccountAddBalanceUseCase::class);
   
        $stub->method('handle')
            ->willReturn(1);
        
        $this->assertEquals(1, $stub->handle(100, 10));
    }
}