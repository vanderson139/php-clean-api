<?php declare(strict_types = 1);

namespace Tests\Api;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    protected function getClient()
    {
        return new Client([
            'base_uri' => 'http://localhost:8000/',
            'http_errors' => false
        ]);
    }

    protected function createAccount($id, $balance = 0)
    {
        $client = $this->getClient();

        $options = [
            RequestOptions::JSON => [
                'type' => 'deposit',
                'destination' => $id,
                'amount' => $balance,
            ]
        ];
        return $client->post('/event', $options);
    }

    public function testCreateAccountWithInitialBalance()
    {
        $response = $this->createAccount(100, 10);
        
        $this->assertEquals(201, $response->getStatusCode());
        
        $expectedBody = '{"destination":{"id":"100","balance":10}}';
        $this->assertEquals($expectedBody, $response->getBody()->getContents());
    }

    public function testDepositIntoExistingAccount()
    {
        $client = $this->getClient();

        $this->createAccount(200);

        $options = [
            RequestOptions::JSON => [
                'type' => 'deposit',
                'destination' => '200',
                'amount' => '100',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(201, $response->getStatusCode());

        $expectedBody = '{"destination":{"id":"200","balance":100}}';
        $this->assertEquals($expectedBody, $response->getBody()->getContents());
    }

    public function testWithdrawFromNonExistingAccount()
    {
        $client = $this->getClient();

        $options = [
            RequestOptions::JSON => [
                'type' => 'withdraw',
                'origin' => '1234',
                'amount' => '10',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('0', $response->getBody()->getContents());
    }

    public function testWithdrawFromExistingAccount()
    {
        $client = $this->getClient();

        $this->createAccount(300, 100);

        $options = [
            RequestOptions::JSON => [
                'type' => 'withdraw',
                'origin' => '300',
                'amount' => '5',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(201, $response->getStatusCode());
        $expectedBody = '{"origin":{"id":"300","balance":95}}';
        $this->assertEquals($expectedBody, $response->getBody()->getContents());
    }

    public function testTransferFromExistingAccount()
    {
        $client = $this->getClient();

        $this->createAccount(400, 100);

        $options = [
            RequestOptions::JSON => [
                'type' => 'transfer',
                'origin' => '400',
                'amount' => '15',
                'destination' => '500',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(201, $response->getStatusCode());
        $expectedBody = '{"origin":{"id":"400","balance":85},"destination":{"id":"500","balance":15}}';
        $this->assertEquals($expectedBody, $response->getBody()->getContents());
    }

    public function testTransferFromNonExistingAccount()
    {
        $client = $this->getClient();

        $options = [
            RequestOptions::JSON => [
                'type' => 'transfer',
                'origin' => '600',
                'amount' => '15',
                'destination' => '300',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('0', $response->getBody()->getContents());
    }

    public function testShouldNotWithdrawMoreThanAvailable()
    {
        $client = $this->getClient();

        $this->createAccount(600, 10);

        $options = [
            RequestOptions::JSON => [
                'type' => 'withdraw',
                'origin' => '600',
                'amount' => '3',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('0', $response->getBody()->getContents());
    }

    public function testShouldWithdrawOnlyBelowLimit()
    {
        $client = $this->getClient();

        $this->createAccount(700, 10);

        $options = [
            RequestOptions::JSON => [
                'type' => 'withdraw',
                'origin' => '700',
                'amount' => '2',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(201, $response->getStatusCode());
        $expectedBody = '{"origin":{"id":"700","balance":8}}';
        $this->assertEquals($expectedBody, $response->getBody()->getContents());
    }
}
