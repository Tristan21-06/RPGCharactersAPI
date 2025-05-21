<?php

namespace App\Database\Query;

class Insert extends AbstractQuery
{

    public function __construct(
        string $table,
        private array $data,
    )
    {
        parent::__construct($table);
    }

    public function build(): string
    {
        $values = array_map(
            fn($value) => "'".$value."'",
            array_values($this->data)
        );

        $fields = implode(', ', array_keys($this->data));
        $values = implode(', ', $values);

        return 'INSERT INTO '. $this->table .' ('. $fields .') VALUES ('. $values .')';
    }
}