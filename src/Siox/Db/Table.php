<?php

namespace Siox\Db;

use Siox\Db\Exception;

use Siox\Db\Table\Column;
use Siox\Db\Table\ColumnInterface;
use Siox\Db\Table\Row;

class Table
{
    protected $name = null;
    protected $type = null;
    protected $columns = null;
    protected $constraints = null;
    protected $comment = null;
    
    public function __construct($name)
    {
        if ($name) {
            $this->setName($name);
        }
    }

    public function addColumn(ColumnInterface $column)
    {
        $name = $column->getName();
        if(isset($this->columns[$name])) {
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
		foreach($columns as $col) {
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
    
    public function setComment($comment)
    {
		$this->comment = $comment;
		return $this;
	}
	
	public function getComment()
	{
		return $this->comment;
	}
}
