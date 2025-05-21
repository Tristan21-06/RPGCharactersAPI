<?php

namespace App\Repository;

use App\Class\Type;

class TypeRepository extends AbstractRepository
{
    public function getTableName(): string
    {
        return Type::getTableName();
    }

    public function populate(array $data): Type
    {
        $type = new Type($data['id'] ?? null);
        $type->setName($data['name']);

        return $type;
    }
}