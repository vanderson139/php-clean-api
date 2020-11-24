<?php declare(strict_types = 1);

namespace Tests\Api;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
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
