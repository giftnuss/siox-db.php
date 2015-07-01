<?php

namespace Siox\Db\Constraint;

class PrimaryKey extends Base
{
    protected $columns;

    public function __construct($columns)
    {
        $this->columns = $columns;
        $upper = array_map('strtoupper', $columns);
        $this->name = implode('_', $upper).'_PK';
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function setColumns($columns)
    {
        $this->columns = $columns;

        return $this;
    }
}
