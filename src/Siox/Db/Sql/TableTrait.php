<?php

namespace Siox\Db\Sql;

use Siox\Db\Table;

trait TableTrait
{
    protected $table;

    public function getTable()
    {
        return $this->table;
    }

    public function setTable(Table $table)
    {
        $this->table = $table;

        return $this;
    }

    public function setTableByName($name)
    {
        $this->table = new Table($name);

        return $this;
    }
}
