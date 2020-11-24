<?php declare(strict_types=1);

namespace Api\Transformer;

use League\Fractal\TransformerAbstract;

class DestinationTransformer extends TransformerAbstract
{
    public function transform($destination)
    {
        return [
            'id' => $destination->id,
            'balance' => (float)$destination->balance
        ];
    }
}