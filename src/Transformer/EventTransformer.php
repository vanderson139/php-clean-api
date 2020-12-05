<?php declare(strict_types=1);

namespace Api\Transformer;

use League\Fractal\TransformerAbstract;

class EventTransformer extends TransformerAbstract
{
    public function transform($event)
    {
        $data = [];
        
        if(!empty($event['origin'])) {
            $data['origin'] = [
                'id' => $event['origin']->getId(),
                'balance' => (float)$event['origin']->get('balance')
            ];
        }

        if(!empty($event['destination'])) {
            $data['destination'] = [
                'id' => $event['destination']->getId(),
                'balance' => (float)$event['destination']->get('balance')
            ];
        }
        
        return $data;
    }
}