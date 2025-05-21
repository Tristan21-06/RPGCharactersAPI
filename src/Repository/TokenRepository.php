<?php

namespace App\Repository;

use App\Class\Token;

class TokenRepository extends AbstractRepository
{
    public function getTableName(): string
    {
        return Token::getTableName();
    }

    public function populate(array $data): Token
    {
        $token = new Token($data['id'] ?? null);
        $token->setToken($data['token']);
        $token->setCanCreate(boolval($data['can_create']));;
        $token->setCanUpdate(boolval($data['can_update']));;
        $token->setCanDelete(boolval($data['can_delete']));;

        $userRepository = new UserRepository();
        $token->setUser($userRepository->findByid($data['user_id']));

        return $token;
    }
}