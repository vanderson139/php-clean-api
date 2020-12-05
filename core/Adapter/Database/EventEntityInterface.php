<?php declare(strict_types = 1);

namespace Core\Adapter\Database;

interface EventEntityInterface extends EntityInterface
{
    public function getOrigin(): ?int;
    public function setOrigin(int $origin = null): EventEntityInterface;

    public function getDestination(): ?int;
    public function setDestination(int $destination = null): EventEntityInterface;
    
    public function getOriginAccount(): ?AccountEntityInterface;
    public function setOriginAccount(?AccountEntityInterface $origin): ?EventEntityInterface;
    
    public function getDestinationAccount(): ?AccountEntityInterface;
    public function setDestinationAccount(?AccountEntityInterface $destination): ?EventEntityInterface;
    
    public function getType(): string;
    public function setType(string $type): ?EventEntityInterface;
    
    public function getAmount(): float;
    public function setAmount(float $amount): ?EventEntityInterface;
}
