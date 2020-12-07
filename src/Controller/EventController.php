<?php declare(strict_types=1);

namespace Api\Controller;

use Api\Database\EventModel;
use Api\Enum\EventType;
use Api\Enum\HttpResponse;
use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Database\EventEntityInterface;
use Core\Factory\UserFactory;
use Api\Serializer\ApiArraySerializer;
use Api\Transformer\EventTransformer;
use League\Fractal\Resource\Item;

class EventController extends AbstractController
{

    public function create()
    {
        $post = $this->getPostData();

        $origin = $this->getAccount((int)$post->origin);

        if ($this->isOriginRequired($post->type) && empty($origin)) {
            return $this->emptyResponse();
        }

        $event = (new EventModel())
            ->setType($post->type)
            ->setOrigin((int)$post->origin)
            ->setDestination((int)$post->destination)
            ->setAmount((float)$post->amount);

        switch ($post->type) {
            case EventType::WITHDRAW:
                $event = UserFactory::makeWithdraw()->execute($event);
                break;
            case EventType::TRANSFER:
                $event = UserFactory::makeTransfer()->execute($event);
                break;
            default:
                $event = UserFactory::makeDeposit()->execute($event);
                break;
        }
        
        if(!$event) {
            return $this->emptyResponse();
        }

        $data = $this->formatResponse($event);

        $this->response->setStatusCode(HttpResponse::CREATED);
        $this->response->setContent($data);
    }

    protected function isOriginRequired($type): bool
    {
        return in_array($type, [
            EventType::WITHDRAW,
            EventType::TRANSFER,
        ]);
    }

    protected function getAccount(int $id = null): ?AccountEntityInterface
    {
        return $id ? UserFactory::getAccount()->execute($id) : null;
    }

    protected function formatResponse(EventEntityInterface $event): string
    {
        $resource = new Item($event, new EventTransformer());

        $this->fractal->setSerializer(new ApiArraySerializer());

        return $this->fractal->createData($resource)->toJson();
    }
    
    protected function emptyResponse()
    {
        $this->response->setStatusCode(HttpResponse::NOT_FOUND);
        $this->response->setContent('0');
    }
}