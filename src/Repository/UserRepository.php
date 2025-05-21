<?php

namespace App\Repository;

use App\Class\User;

class UserRepository extends AbstractRepository
{

    public function getTableName(): string
    {
        return User::getTableName();
    }

    public function populate(array $data): User
    {
        $user = new user($data['id'] ?? null);
        $user->setName($data['name']);
        $user->setPassword($data['password']);

        return $user;
    }
}