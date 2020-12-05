<?php declare(strict_types = 1);

namespace Core\Adapter\Database;

interface EntityInterface
{
    public function getId(): ?string;
    public function get(string $property);
    public function set($property, $value): EntityInterface;
    public function toArray(): array;
}
