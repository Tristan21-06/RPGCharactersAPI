<?php

namespace App\Database\Query;

abstract class AbstractQuery
{

    public function __construct(
        protected string $table
    )
    {
    }

    abstract public function build(): string;

    protected function getWhereClause(array $where): string
    {
        if(empty($where)) return 'WHERE 1';

        $mappedWhere = array_map(
            function ($key, $value) {
                if (is_array($value)) {
                    if (empty($value)) return '1';

                    $value = array_map(fn($v) => "'". $v ."'", $value);
                    return sprintf('%s IN (%s)', $key, implode(', ', $value));
                }

                return $key ." = '". $value ."'";
            },
            array_keys($where),
            array_values($where)
        );

        return ' WHERE '. implode(' AND ', $mappedWhere);
    }

    protected function getSetClause(array $data): string
    {
        if(empty($data)) throw new \Exception('No data to set');

        $mappedData = array_map(
            fn($key, $value) => $key ." = '". $value ."'",
            array_keys($data),
            array_values($data)
        );

        return ' SET '. implode(', ', $mappedData);
    }
}