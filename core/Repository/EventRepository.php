<?php declare(strict_types = 1);

namespace Core\Repository;

use Core\Adapter\EventRepositoryInterface;

class EventRepository extends AbstractRepository implements EventRepositoryInterface
{
    protected $table = 'events';
}