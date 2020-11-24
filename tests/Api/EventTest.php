<?php declare(strict_types = 1);

namespace Tests\Api;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testCreateAccountWithInitialBalance()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000/',
            'http_errors' => false
        ]);
        
        $options = [
            RequestOptions::JSON => [
                'type' => 'deposit',
                'destination' => '100',
                'amount' => '10',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(201, $response->getStatusCode());
        
        $expectedBody = '{"destination":{"id":"100","balance":10}}';
        $this->assertEquals($expectedBody, $response->getBody()->getContents());
    }

    public function testDepositIntoExistingAccount()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000/',
            'http_errors' => false
        ]);

        $options = [
            RequestOptions::JSON => [
                'type' => 'deposit',
                'destination' => '100',
                'amount' => '10',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(201, $response->getStatusCode());

        $expectedBody = '{"destination":{"id":"100","balance":20}}';
        $this->assertEquals($expectedBody, $response->getBody()->getContents());
    }

    public function testWithdrawFromNonExistingAccount()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000/',
            'http_errors' => false
        ]);

        $options = [
            RequestOptions::JSON => [
                'type' => 'withdraw',
                'origin' => '200',
                'amount' => '10',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('0', $response->getBody()->getContents());
    }

    public function testWithdrawFromExistingAccount()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000/',
            'http_errors' => false
        ]);

        $options = [
            RequestOptions::JSON => [
                'type' => 'withdraw',
                'origin' => '100',
                'amount' => '5',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(201, $response->getStatusCode());
        $expectedBody = '{"origin":{"id":"100","balance":15}}';
        $this->assertEquals($expectedBody, $response->getBody()->getContents());
    }

    public function testTransferFromExistingAccount()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000/',
            'http_errors' => false
        ]);

        $options = [
            RequestOptions::JSON => [
                'type' => 'transfer',
                'origin' => '100',
                'amount' => '15',
                'destination' => '300',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(201, $response->getStatusCode());
        $expectedBody = '{"origin":{"id":"100","balance":0},"destination":{"id":"300","balance":15}}';
        $this->assertEquals($expectedBody, $response->getBody()->getContents());
    }

    public function testTransferFromNonExistingAccount()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000/',
            'http_errors' => false
        ]);

        $options = [
            RequestOptions::JSON => [
                'type' => 'transfer',
                'origin' => '200',
                'amount' => '15',
                'destination' => '300',
            ]
        ];
        $response = $client->post('/event', $options);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('0', $response->getBody()->getContents());
    }
}
