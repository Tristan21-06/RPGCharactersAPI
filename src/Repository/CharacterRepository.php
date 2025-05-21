<?php

namespace App\Repository;

use App\Class\Character;

class CharacterRepository extends AbstractRepository
{
    public function getTableName(): string
    {
        return Character::getTableName();
    }

    public function populate(array $data): Character
    {
        $character = new Character($data['id'] ?? null);
        $character->setName($data['name']);
        $character->setStrength($data['strength']);
        $character->setDefense($data['defense']);
        $character->setHp($data['hp']);
        $character->setAvatarPath($data['avatar_path'] ?? '');

        $typeRepository = new TypeRepository();
        $character->setType($typeRepository->findByid($data['type_id']));

        return $character;
    }
}