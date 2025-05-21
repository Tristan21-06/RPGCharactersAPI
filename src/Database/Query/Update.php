<?php

namespace App\Database\Query;

class Update extends AbstractQuery
{
    public function __construct(
        string $table,
        private array $data,
        private array $where = [],
    )
    {
        parent::__construct($table);
    }

    public function build(): string
    {
        return sprintf(
            'UPDATE %s %s %s',
            $this->table,
            $this->getSetClause($this->data),
            $this->getWhereClause($this->where)
        );
    }
}