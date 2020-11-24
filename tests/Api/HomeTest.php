<?php declare(strict_types = 1);

namespace Tests\Api;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class HomeTest extends TestCase
{
    public function testGetHome()
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->get('/');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
