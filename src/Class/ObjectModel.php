<?php

namespace App\Class;

use App\Database\Db;

abstract class ObjectModel
{
    abstract public static function getTableName(): string;

    public function __construct(protected ?int $id = null)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    abstract public function toArray(bool $dbQuery = false): array;

    public function save(): bool|\PDOStatement
    {
        $data = $this->toArray(true);

        $db = new Db();

        if ($this->id !== null) {
            return $db->update($this::getTableName(), $data, ['id' => $this->id]);
        }

        unset($data['id']);
        $stmt = $db->insert($this::getTableName(), $data);
        $this->id = (int) $db->lestInsertId();

        return $stmt;
    }

    public function delete(): bool|\PDOStatement
    {
        $db = new Db();

        return $db->delete($this::getTableName(), ['id' => $this->id]);
    }
}