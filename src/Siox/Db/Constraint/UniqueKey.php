<?php

namespace Siox\Db\Constraint;

class UniqueKey extends Base
{
	protected $columns;
	
	public function __construct($columns)
	{
		$this->columns = $columns;
        $upper = array_map('strtoupper',$columns);
        $this->name = join('_', $upper) . '_UNIQ';
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

