<?php declare(strict_types = 1);

namespace Api\Database;

use Core\Adapter\Database\EntityInterface;

abstract class AbstractModel implements EntityInterface
{
    protected $data = [];
    
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getId(): ?int
    {
        return isset($this->data['id']) ? (int)$this->data['id'] : null;
    }

    public function setId(int $id): EntityInterface
    {
        $this->set('id', $id);
        return $this;
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

    public function fill(array $data = []): EntityInterface
    {
        $this->data = $data;
        
        return $this;
    }
}
