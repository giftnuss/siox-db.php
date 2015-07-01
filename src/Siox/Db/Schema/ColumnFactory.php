<?php

namespace Siox\Db\Schema;

use Siox\Db\Table\Column;

class ColumnFactory extends AbstractTableFactory
{
    public function __call($type, $args)
    {
        if ($typeObj = $this->schema->getType($type)) {
            $column = new Column($this->table);
            $column->setName($args[0]);
            $column->setType($typeObj);
            $this->tableObj->addColumn($column);
            $this->current = $column;
        }

        return $this;
    }
}
