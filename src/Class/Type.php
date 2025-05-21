<?php

namespace App\Class;

class Type extends ObjectModel
{
    private string $name = '';

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public static function getTableName(): string
    {
        return 'types';
    }

    public function toArray(bool $dbQuery = false): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}