<?php

namespace App\Controller;

use App\Repository\TypeRepository;

class TypeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct(new TypeRepository());
    }
}