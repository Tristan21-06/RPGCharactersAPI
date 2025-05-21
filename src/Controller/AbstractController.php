<?php

namespace App\Controller;

use App\Class\ObjectModel;
use App\Repository\AbstractRepository;

abstract class AbstractController
{
    public function __construct(
        protected AbstractRepository $repository
    )
    {
    }

    protected function getEntity(string $identifier): ObjectModel
    {
        return $this->repository->findByid((int)$identifier);
    }

    public function list(): void
    {
        try {
            $entities = $this->repository->findAll();
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()], JSON_PRETTY_PRINT);
            return;
        }

        $this->jsonResponse(array_map(fn(ObjectModel $entity) => $entity->toArray(), $entities));
    }

    public function show(string $identifier): void
    {
        try {
            $entity = $this->getEntity($identifier);
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()], JSON_PRETTY_PRINT);
            return;
        }

        $this->jsonResponse($entity->toArray());
    }

    public function create(): void
    {
        try {
            $entity = $this->repository->populate($_REQUEST);
            $entity->save();
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()], JSON_PRETTY_PRINT);
            return;
        }

        $this->jsonResponse($entity->toArray());
    }

    public function update(string $identifier): void
    {
        try {
            $entity = $this->getEntity($identifier);
            $data = array_merge($entity->toArray(true), $_REQUEST);
            $entity = $this->repository->populate($data);
            $entity->save();
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()], JSON_PRETTY_PRINT);
            return;
        }

        $this->jsonResponse($entity->toArray());
    }

    public function delete(string $identifier): void
    {
        try {
            $entity = $this->getEntity($identifier);
            $entity->delete();
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()], JSON_PRETTY_PRINT);
            return;
        }

        $this->jsonResponse($entity->toArray());
    }

    protected function jsonResponse(array $data): void
    {
        http_response_code(200);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}