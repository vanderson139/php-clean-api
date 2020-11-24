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
                'id' => $event['origin']->id,
                'balance' => (float)$event['origin']->balance
            ];
        }

        if(!empty($event['destination'])) {
            $data['destination'] = [
                'id' => $event['destination']->id,
                'balance' => (float)$event['destination']->balance
            ];
        }
        
        return $data;
    }
}