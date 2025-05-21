<?php

namespace App\Class;

class Token extends ObjectModel
{
    private string $token = '';
    private ?User $user = null;
    private bool $canCreate = false;
    private bool $canUpdate = false;
    private bool $canDelete = false;

    public function isCanDelete(): bool
    {
        return $this->canDelete;
    }

    public function isCanUpdate(): bool
    {
        return $this->canUpdate;
    }

    public function isCanCreate(): bool
    {
        return $this->canCreate;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    public function setCanCreate(bool $canCreate): void
    {
        $this->canCreate = $canCreate;
    }

    public function setCanUpdate(bool $canUpdate): void
    {
        $this->canUpdate = $canUpdate;
    }

    public function setCanDelete(bool $canDelete): void
    {
        $this->canDelete = $canDelete;
    }

    public static function getTableName(): string
    {
        return 'tokens';
    }

    public function toArray(bool $dbQuery = false): array
    {
        if ($dbQuery) {
            $manyToOne = [
                'user_id' => $this->user->getId(),
            ];
        } else {
            $manyToOne = [
                'user' => $this->user->toArray(),
            ];
        }

        return array_merge([
            'id' => $this->id,
            'can_create' => $this->canCreate,
            'can_update' => $this->canUpdate,
            'can_delete' => $this->canDelete,
        ], $manyToOne);
    }
}