<?php declare(strict_types=1);

namespace Api\Controller;

use Api\Factory\AccountFactory;
use Api\Factory\EventFactory;
use Api\Serializer\ApiArraySerializer;
use Api\Transformer\EventTransformer;
use Http\Request;
use Http\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class EventController extends BaseController
{
    public function __construct(Request $request,
                                Response $response,
                                Manager $fractal,
                                ApiArraySerializer $destinationSerializer)
    {
        parent::__construct($request, $response, $fractal);
        $this->fractal->setSerializer($destinationSerializer);
    }

    public function create()
    {
        $post = $this->getPostData();

        $origin = $this->getAccount($post->origin);
        $destination = $this->getAccount($post->destination);

        if ($post->type == 'withdraw' && empty($origin)) {
            $this->response->setStatusCode(404);
            $this->response->setContent('0');
            return;
        }

        if ($post->type == 'deposit' && empty($destination)) {
            $this->createAccount([
                'id' => $post->destination,
                'balance' => 0
            ]);
        }

        EventFactory::createEvent()->handle($post->type, $post->origin, $post->destination, $post->amount);

        $resource = new Item([
            'destination' => $this->getAccount($post->destination), 
            'origin' => $this->getAccount($post->origin)
        ], new EventTransformer());

        $data = $this->fractal->createData($resource)->toJson();

        $this->response->setStatusCode(201);
        $this->response->setContent($data);
    }

    protected function getAccount($id)
    {
        return $id ? AccountFactory::getAccount()->handle($id) : null;
    }

    protected function createAccount($data)
    {
        return AccountFactory::createAccount()->handle($data);
    }
}