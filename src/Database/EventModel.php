<?php declare(strict_types = 1);

namespace Api\Database;

use Core\Adapter\Database\AccountEntityInterface;
use Core\Adapter\Database\EventEntityInterface;

class EventModel extends AbstractModel implements EventEntityInterface
{
    protected $originAccount;
    protected $destinationAccount;

    public function getOriginAccount(): ?AccountEntityInterface
    {
        return $this->originAccount;
    }

    public function setOriginAccount(?AccountEntityInterface $origin): ?EventEntityInterface
    {
        $this->originAccount = $origin;
        return $this;
    }

    public function getDestinationAccount(): ?AccountEntityInterface
    {
        return $this->destinationAccount;
    }

    public function setDestinationAccount(?AccountEntityInterface $destination): ?EventEntityInterface
    {
        $this->destinationAccount = $destination;
        return $this;
    }

    public function getType(): string
    {
        return $this->get('type');
    }

    public function setType(string $type): ?EventEntityInterface
    {
        $this->set('type', $type);
        return $this;
    }

    public function getAmount(): float
    {
        return (float)$this->get('amount');
    }

    public function setAmount(float $amount): ?EventEntityInterface
    {
        $this->set('amount', $amount);
        return $this;
    }

    public function getOrigin(): ?int
    {
        return $this->get('origin');
    }

    public function setOrigin(int $origin = null): EventEntityInterface
    {
        $this->set('origin', $origin);
        return $this;
    }

    public function getDestination(): ?int
    {
        return $this->get('destination');
    }

    public function setDestination(int $destination = null): EventEntityInterface
    {
        $this->set('destination', $destination);
        return $this;
    }
}
