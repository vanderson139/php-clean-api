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
        var_dump($response->getBody()->getContents());
        $this->assertEquals($expectedBody, $response->getBody());
    }
}
