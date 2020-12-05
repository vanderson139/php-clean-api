<?php declare(strict_types = 1);

namespace Core\Adapter\Database;

interface EntityInterface
{
    public function getId(): ?int;
    public function setId(int $id): EntityInterface;
    public function get(string $property);
    public function set($property, $value): EntityInterface;
    public function fill(array $data = []): EntityInterface;
    public function toArray(): array;
}
