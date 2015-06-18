<?php

namespace Siox\Db\Sql;

use Siox\Db\Sql\Exception as SqlException;
use Exception as CoreException;

class CreateTable extends Base implements SqlInterface
{
    protected $table;

    public function exec()
    {
        try {
            $this->sql->getDb()->exec($this->getSqlString());

            return true;
        } catch (CoreException $e) {
            throw new SqlException($e->getMessage());
        }
    }

    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    public function getSqlString()
    {
        $platform = $this->getPlatform();
        $sql = 'CREATE TABLE '.
            $platform->quoteIdentifier($this->table->getTableName()).
            " (\n    ";

        $result = array();
        foreach ($this->table->getColumns() as $col) {
            $column = $this->defineColumn($col);
            $result[] = $column->getSqlString();
        }
        foreach ($this->table->getConstraints() as $cst) {
            $constraint = $this->defineConstraint($cst);
            $result[] = $constraint->getSqlString();
        }

        $sql .= implode(",\n    ", $result);
        $sql .= "\n)";

        return $sql;
    }

    public function defineColumn($col)
    {
        $column = new DefineColumn($this->sql);
        $column->setColumn($col);

        return $column;
    }

    public function defineConstraint($con)
    {
        $constraint = new DefineConstraint($this->sql);
        $constraint->setConstraint($con);

        return $constraint;
    }
}
