<?php

namespace App\Controller;

use App\Class\ObjectModel;
use App\Repository\CharacterRepository;

class CharacterController extends AbstractController
{
    public function __construct()
    {
        parent::__construct(new CharacterRepository());
    }

    protected function getEntity(string $identifier): ObjectModel
    {
        return $this->repository->findOneBy(['name' => $identifier]);
    }

    protected function create(): string
    {
        if (empty($_REQUEST['password'])) {
             $_REQUEST['password'] = 'password';
        }
        $_REQUEST['password'] = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        
        parent::create();
    }
}
