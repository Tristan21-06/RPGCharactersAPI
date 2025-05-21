<?php

namespace App\Database;

use App\Database\Query\Delete;
use App\Database\Query\Insert;
use App\Database\Query\Select;
use App\Database\Query\Update;
use PDO;

class Db
{
    private PDO $connection;
    public function __construct()
    {
        $this->connection = new PDO('mysql:host=localhost;dbname='. $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PWD']);
    }

    public function select(string $table, array $select = ['*'], array $where = [], array $order = [], int $limit = 0): array
    {
        $selectQuery = new Select($table, $select, $where, $order, $limit);

        return $this->connection->query($selectQuery->build())->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(string $table, array $data): bool|\PDOStatement
    {
        $insertQuery = new Insert($table, $data);

        return $this->connection->query($insertQuery->build());
    }

    public function lestInsertId(): bool|string
    {
        return $this->connection->lastInsertId();
    }

    public function update(string $table, array $data, array $where = []): bool|\PDOStatement
    {
        $updateQuery = new Update($table, $data, $where);

        return $this->connection->query($updateQuery->build());
    }

    public function delete(string $table, array $where = []): bool|\PDOStatement
    {
        $deleteQuery = new Delete($table, $where);

        return $this->connection->query($deleteQuery->build());
    }
}