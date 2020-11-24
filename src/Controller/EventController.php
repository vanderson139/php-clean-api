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
        
        if($post->origin) {
            $origin = $this->getAccount($post->origin);
        }

        if($post->destination) {
            $destination = $this->getAccount($post->destination);
        }
        
        if($post->type == 'withdraw' && empty($origin)) {
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

        EventFactory::createEvent()->handle($post->type, $post->destination, $post->amount);
        
        $account = $this->getAccount($post->destination);
        
        $resource = new Item($account, new DestinationTransformer());

        $data = $this->fractal->createData($resource)->toJson();

        $this->response->setStatusCode(201);
        $this->response->setContent($data);
    }

    protected function getAccount($id)
    {
        return AccountFactory::getAccount()->handle($id);
    }

    protected function createAccount($data)
    {
        return AccountFactory::createAccount()->handle($data);
    }
}