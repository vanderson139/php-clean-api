<?php

use GuzzleHttp\Client;

class HomeTest extends \PHPUnit\Framework\TestCase
{
    public function testGetHome()
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->get('/');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
