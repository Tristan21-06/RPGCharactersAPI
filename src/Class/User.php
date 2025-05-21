<?php

namespace App\Class;

class User extends ObjectModel
{
    private string $name = '';
    private string $password = '';

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public static function getTableName(): string
    {
        return 'users';
    }

    public function toArray(bool $dbQuery = false): array
    {
        return [
            'name' => $this->name,
            'password' => $this->password,
        ];
    }
}