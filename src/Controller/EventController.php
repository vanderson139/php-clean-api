<?php declare(strict_types = 1);

namespace Api\Controller;

use Api\Factory\EventFactory;

class EventController extends BaseController
{

    public function create()
    {
        $post = json_decode($this->request->getRawBody());
        $data = [
            'type' => $post->type,
            'destination' => $post->destination,
            'amount' => $post->amount
        ];
        
        EventFactory::createEvent()->handle($data);
        
        $response = [
            'destination' => [
                'id' => $data['destination'],
                'balance' => (float)$data['amount']
            ]
        ];

        $this->response->setStatusCode(201);
        $this->response->setContent(json_encode($response));
    }
}