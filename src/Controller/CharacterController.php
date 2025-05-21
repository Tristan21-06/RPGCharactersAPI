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
}