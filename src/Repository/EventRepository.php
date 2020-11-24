<?php declare(strict_types = 1);

namespace Api\Repository;

use Api\Adapter\EventRepositoryInterface;

class EventRepository extends AbstractRepository implements EventRepositoryInterface
{
    protected $table = 'events';
}