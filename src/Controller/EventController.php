<?php declare(strict_types=1);

namespace Api\Controller;

use Api\Database\AccountModel;
use Api\Enum\EventType;
use Api\Enum\HttpResponse;
use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Database\EventEntityInterface;
use Core\Factory\UserFactory;
use Api\Serializer\ApiArraySerializer;
use Api\Transformer\EventTransformer;
use http\Client\Curl\User;
use League\Fractal\Resource\Item;

class EventController extends AbstractController
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
            $destination = $this->createAccount([
                'id' => $post->destination,
                'balance' => 0
            ]);
        }
        
        switch ($post->type) {
            case EventType::WITHDRAW:
                $success = UserFactory::accountSubBalance()->execute($origin, (float)$post->amount);
                break;
            case EventType::TRANSFER:
                $success = UserFactory::accountSubBalance()->execute($origin, (float)$post->amount);
                $success = UserFactory::accountAddBalance()->execute($destination, (float)$post->amount);
                break;
            default:
                $success = UserFactory::accountAddBalance()->execute($destination, (float)$post->amount);
                break;
        }

        if(!$success) {
            $this->response->setStatusCode(HttpResponse::NOT_FOUND);
            $this->response->setContent('0');
            return;
        }
        
        $event = UserFactory::createEvent()->execute($post->type, (float)$post->amount, $destination, $origin);

        $data = $this->formatResponse($event);

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

    protected function getAccount($id): ?AccountEntityInterface
    {
        return $id ? UserFactory::getAccount()->execute($id) : null;
    }

    protected function createAccount($data): ?AccountEntityInterface
    {
        return UserFactory::createAccount()->execute(new AccountModel($data));
    }

    protected function formatResponse(EventEntityInterface $event)
    {
        $resource = new Item($event, new EventTransformer());

        $this->fractal->setSerializer(new ApiArraySerializer());

        return $this->fractal->createData($resource)->toJson();
    }
}