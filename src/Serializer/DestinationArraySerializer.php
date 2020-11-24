<?php

namespace Api\Serializer;

use League\Fractal\Serializer\ArraySerializer;

class DestinationArraySerializer extends ArraySerializer
{
    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        return ['destination' => $data];
    }

    /**
     * Serialize null resource.
     *
     * @return array
     */
    public function null()
    {
        return ['destination' => []];
    }
}
