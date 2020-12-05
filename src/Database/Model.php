<?php declare(strict_types = 1);

namespace Api\Database;

use Core\Adapter\Database\EntityInterface;

class Model implements EntityInterface
{
    protected $data = [];
    
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getId(): ?string
    {
        return isset($this->data['id']) ? (string)$this->data['id'] : null;
    }

    public function get(string $property)
    {
        return isset($this->data[$property]) ? $this->data[$property] : null;
    }

    public function set($property, $value): EntityInterface
    {
        $this->data[$property] = $value;
        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
