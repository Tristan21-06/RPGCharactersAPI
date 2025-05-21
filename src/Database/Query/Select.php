<?php

namespace App\Database\Query;

class Select extends AbstractQuery
{
    public function __construct(
        string $table,
        private array    $select = ['*'],
        private array    $where = [],
        private array    $order = [],
        private int      $limit = 0,
    )
    {
        parent::__construct($table);
    }

    public function build(): string
    {
        $sql = 'SELECT '. implode(', ', $this->select) .' FROM '. $this->table;
        if (!empty($this->where)) {
            $sql .= $this->getWhereClause($this->where);
        }
        if (!empty($this->order)) {
            $sql .= ' ORDER BY '. implode(', ', $this->order);
        }
        if ($this->limit > 0) {
            $sql .= ' LIMIT '. $this->limit;
        }

        return $sql;
    }
}