<?php

namespace Siox\Db\Schema;

use Siox\Db\Constraint\PrimaryKey;
use Siox\Db\Schema;
use Siox\Db\Table;

class AbstractTableFactory
{
    protected $schema;
    protected $tableObj;
    protected $current;

    public function __construct(Schema $schema, Table $table)
    {
        $this->tableObj = $table;
        $this->schema = $schema;
    }

    public function __get($attr)
    {
        if ($attr == 'column') {
            return new ColumnFactory($this->schema, $this->tableObj);
        } elseif ($attr == 'constraint') {
            return new ConstraintFactory($this->schema, $this->tableObj);
        } elseif ($attr == 'table') {
            return  new TableFactory($this->schema, $this->tableObj);
        }

        return;
    }

    public function pk()
    {
        $columns = func_get_args();
        $pk = new PrimaryKey($columns);
        $this->tableObj->addConstraint($pk);
        $this->current = $pk;

        return $this;
    }

    public function comment($comment)
    {
        if (isset($this->current)) {
            $this->current->setComment($comment);
        } else {
            $this->tableObj->setComment($comment);
        }

        return $this;
    }
}
