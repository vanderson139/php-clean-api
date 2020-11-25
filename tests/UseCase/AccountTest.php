<?php declare(strict_types = 1);

namespace Tests\UseCase;

use Core\UseCase\CreateAccountUseCase;
use Core\UseCase\UpdateAccountUseCase;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testCreateAccount()
    {
        $data = ['balance' => 10];
   
        $stub = $this->createMock(CreateAccountUseCase::class);
   
        $stub->method('handle')
            ->willReturn($data);
   
        $this->assertEquals($data, $stub->handle($data));
    }

    public function testUpdateAccount()
    {
        $data = ['balance' => 10];
        
        $stub = $this->createMock(UpdateAccountUseCase::class);
   
        $stub->method('addBalance')
            ->willReturn($data);
        
        $this->assertEquals($data, $stub->addBalance(100, 10));
    }
}