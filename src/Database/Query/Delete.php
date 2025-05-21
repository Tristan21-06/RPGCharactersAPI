<?php

namespace App\Database\Query;

class Delete extends AbstractQuery
{
    public function __construct(
        string $table,
        private array $where = [],
    )
    {
        parent::__construct($table);
    }

    public function build(): string
    {
        return 'DELETE FROM '. $this->table . $this->getWhereClause($this->where);
    }
}