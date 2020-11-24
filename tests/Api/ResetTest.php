<?php declare(strict_types = 1);

namespace Tests\Api;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ResetTest extends TestCase
{
    public function testGetReset()
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->get('/reset');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getBody());
    }
}
