<?php

namespace App\Repository;

use App\Class\ObjectModel;
use App\Database\Db;

abstract class AbstractRepository
{
    private Db $db;
    public function __construct()
    {
        $this->db = new Db();
    }

    abstract public function getTableName(): string;
    abstract public function populate(array $data): ObjectModel;

    public function findAll(): array
    {
        $entities = $this->db->select($this->getTableName());

        return array_map(fn($entity) => $this->populate($entity), $entities);
    }

    public function findBy(array $criteria): array
    {
        $entities = $this->db->select($this->getTableName(), where: $criteria);

        return array_map(fn($entity) => $this->populate($entity), $entities);
    }

    public function findByid(int $id): ObjectModel
    {
        $entities = $this->db->select($this->getTableName(), where: ['id' => $id], limit: 1);

        if (empty($entities)) {
            throw new \Exception(sprintf('Entity not found for id %s', $id));
        }

        return $this->populate(array_shift($entities));
    }

    public function findOneBy(array $criteria): ObjectModel
    {
        $entities = $this->db->select($this->getTableName(), where: $criteria, limit: 1);

        if (empty($entities)) {
            throw new \Exception('Entity not found for criterias : '. json_encode($criteria));
        }

        return $this->populate(array_shift($entities));
    }
}