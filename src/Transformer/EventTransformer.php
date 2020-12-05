<?php declare(strict_types=1);

namespace Api\Transformer;

use Core\Adapter\Database\EventEntityInterface;
use League\Fractal\TransformerAbstract;

class EventTransformer extends TransformerAbstract
{
    public function transform(EventEntityInterface $event)
    {
        $data = [];
        
        if($event->getOriginAccount()) {
            $data['origin'] = [
                'id' => $event->getOriginAccount()->getId(),
                'balance' => $event->getOriginAccount()->getBalance()
            ];
        }

        if($event->getDestinationAccount()) {
            $data['destination'] = [
                'id' => $event->getDestinationAccount()->getId(),
                'balance' => $event->getDestinationAccount()->getBalance()
            ];
        }
        
        return $data;
    }
}