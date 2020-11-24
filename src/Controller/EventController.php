<?php declare(strict_types=1);

namespace Api\Controller;

use Api\Enum\EventType;
use Api\Enum\HttpResponse;
use Api\Factory\UserFactory;
use Api\Serializer\ApiArraySerializer;
use Api\Transformer\EventTransformer;
use League\Fractal\Resource\Item;

class EventController extends BaseController
{

    public function create()
    {
        $post = $this->getPostData();

        $origin = $this->getAccount($post->origin);
        $destination = $this->getAccount($post->destination);

        if ($this->isOriginRequired($post->type) && empty($origin)) {
            $this->response->setStatusCode(HttpResponse::NOT_FOUND);
            $this->response->setContent('0');
            return;
        }

        if ($this->isDestinationRequired($post->type) && empty($destination)) {
            $this->createAccount([
                'id' => $post->destination,
                'balance' => 0
            ]);
        }

        UserFactory::createEvent()->handle($post->type, $post->origin, $post->destination, $post->amount);

        $data = $this->formatResponse($post->origin, $post->destination);

        $this->response->setStatusCode(HttpResponse::CREATED);
        $this->response->setContent($data);
    }
    
    protected function isOriginRequired($type)
    {
        return in_array($type, [
           EventType::WITHDRAW, 
           EventType::TRANSFER, 
        ]);
    }
    
    protected function isDestinationRequired($type)
    {
        return in_array($type, [
            EventType::DEPOSIT,
            EventType::TRANSFER,
        ]);
    }

    protected function getAccount($id)
    {
        return $id ? UserFactory::getAccount()->handle($id) : null;
    }

    protected function createAccount($data)
    {
        return UserFactory::createAccount()->handle($data);
    }

    protected function formatResponse($origin, $destination)
    {
        $resource = new Item([
            'destination' => $this->getAccount($destination),
            'origin' => $this->getAccount($origin)
        ], new EventTransformer());

        $this->fractal->setSerializer(new ApiArraySerializer());

        return $this->fractal->createData($resource)->toJson();
    }
}