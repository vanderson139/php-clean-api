<?php

use GuzzleHttp\Client;

class ResetTest extends \PHPUnit\Framework\TestCase
{
    public function testGetReset()
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->get('/reset');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getBody());
    }
}
