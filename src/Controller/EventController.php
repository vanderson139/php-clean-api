<?php declare(strict_types=1);

namespace Api\Controller;

use Api\Factory\AccountFactory;
use Api\Factory\EventFactory;
use Api\Serializer\DestinationArraySerializer;
use Api\Transformer\DestinationTransformer;
use Http\Request;
use Http\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class EventController extends BaseController
{
    public function __construct(Request $request, 
                                Response $response, 
                                Manager $fractal, 
                                DestinationArraySerializer $destinationSerializer)
    {
        parent::__construct($request, $response, $fractal);
        $this->fractal->setSerializer($destinationSerializer);
    }

    public function create()
    {
        $post = $this->getPostData();

        $data = [
            'type' => $post->type,
            'destination' => $post->destination,
            'amount' => $post->amount
        ];

        $account = $this->getDestination($post->destination);

        if (empty($account)) {
            $account = $this->createAccount([
                'id' => $data['destination'],
                'balance' => $data['amount']
            ]);
        }

        EventFactory::createEvent()->handle($data);

        $resource = new Item($account, new DestinationTransformer());

        $data = $this->fractal->createData($resource)->toJson();

        $this->response->setStatusCode(201);
        $this->response->setContent($data);
    }

    protected function getDestination($id)
    {
        return AccountFactory::getAccount()->handle($id);
    }

    protected function createAccount($data)
    {
        return AccountFactory::createAccount()->handle($data);
    }
}