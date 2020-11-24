<?php

use GuzzleHttp\Client;

class AccountTest extends \PHPUnit\Framework\TestCase
{
    public function testGetBalanceForNonExistingAccount()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8000/',
            'http_errors' => false
        ]);
        $response = $client->get('/balance?account_id=1234');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('0', $response->getBody());
    }
}
