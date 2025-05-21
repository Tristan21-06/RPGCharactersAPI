<?php

namespace App\Core;

use App\Class\Token;
use App\Repository\TokenRepository;

class Auth
{
    const ACTIONS_SECURED = ['create', 'update', 'delete'];

    private TokenRepository $tokenRepository;
    public function __construct()
    {
        $this->tokenRepository = new TokenRepository();
    }

    public function checkAuthorization(string $action): bool
    {
        if (!in_array($action, self::ACTIONS_SECURED)) {
            return true;
        }

        $token = $this->getToken();
        if (!$token) {
            return false;
        }

        return $this->checkToken($token, $action);
    }

    private function getToken(): string
    {
        $headers = apache_request_headers();
        var_dump("a",$headers);die;
        if (empty($headers)) {
            return false;
        }

        if (!isset($headers['api-key'])) {
            return false;
        }

        return $headers['api-key'];
    }

    public function checkToken(string $token, string $action): bool
    {
        if (empty($token)) return false;

        try {
            /** @var Token $searchedToken */
            $searchedToken = $this->tokenRepository->findOneBy(['token' => $token]);
        } catch (\Exception $e) {
            return false;
        }


        return match ($action) {
            'create' => $searchedToken->isCanCreate(),
            'update' => $searchedToken->isCanUpdate(),
            'delete' => $searchedToken->isCanDelete(),
            default => true,
        };

    }
}