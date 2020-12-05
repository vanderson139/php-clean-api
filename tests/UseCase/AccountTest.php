<?php declare(strict_types = 1);

namespace Tests\UseCase;

use Api\Database\AccountModel;
use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Database\EntityInterface;
use Core\UseCase\AccountAddBalanceUseCase;
use Core\UseCase\CreateAccountUseCase;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testCreateAccount()
    {
        $data = ['balance' => 10];
        $entity = $this->createMock(AccountEntityInterface::class);
        $stub = $this->createMock(CreateAccountUseCase::class);
   
        $stub->method('execute')
            ->willReturn($entity);
   
        $this->assertEquals($entity, $stub->execute($data));
    }

    public function testUpdateAccount()
    {
        $entity = $this->createMock(AccountEntityInterface::class);
        $stub = $this->createMock(AccountAddBalanceUseCase::class);
   
        $stub->method('execute')
            ->willReturn(true);
        
        $this->assertEquals(true, $stub->execute($entity, 10));
    }
}