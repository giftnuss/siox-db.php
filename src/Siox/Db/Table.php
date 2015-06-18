<?php

namespace Siox\Db;

use Siox\Db\Table\Column;
use Siox\Db\Table\ColumnInterface;

class Table
{
    protected $prefix = '';
    protected $name = null;
    protected $columns = array();
    protected $constraints = array();
    protected $comment = null;

    public function __construct($name)
    {
        if ($name) {
            $this->setName($name);
        }
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function addColumn(ColumnInterface $column)
    {
        $name = $column->getName();
        if (isset($this->columns[$name])) {
            throw new Exception("Column $name is already defined");
        }
        $this->columns[$name] = $column;

        return $this;
    }

    public function addConstraint($constraint)
    {
        $this->constraints[] = $constraint;

        return $this;
    }

    public function setColumns(array $columns)
    {
        $this->columns = array();
        foreach ($columns as $col) {
            $this->addColumn($column);
        }
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function setConstraints($constraints)
    {
        $this->constraints = $constraints;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTableName()
    {
        if (strlen($this->prefix)) {
            return implode('_', array($this->prefix, $this->getName()));
        }

        return $this->getName();
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getColumnNames()
    {
        #; U
    }
}
