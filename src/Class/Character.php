<?php

namespace App\Class;

class Character extends ObjectModel
{
    private string $name = '';
    private ?Type $type = null;
    private int $strength = 0;
    private int $defense = 0;
    private int $hp = 0;
    private string $avatarPath = '';

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }

    public function setStrength(int $strength): void
    {
        $this->strength = $strength;
    }

    public function setDefense(int $defense): void
    {
        $this->defense = $defense;
    }

    public function setHp(int $hp): void
    {
        $this->hp = $hp;
    }

    public function setAvatarPath(string $avatarPath): void
    {
        $this->avatarPath = $avatarPath;
    }

    public static function getTableName(): string
    {
        return 'characters';
    }

    public function toArray(bool $dbQuery = false): array
    {
        if ($dbQuery) {
            $manyToOne = [
                'type_id' => $this->type->getId(),
            ];
        } else {
            $manyToOne = [
                'type' => $this->type->toArray(),
            ];
        }

        return array_merge([
            'id' => $this->id,
            'name' => $this->name,
            'strength' => $this->strength,
            'defense' => $this->defense,
            'hp' => $this->hp,
            'avatar_path' => $this->avatarPath,
        ], $manyToOne);
    }
}