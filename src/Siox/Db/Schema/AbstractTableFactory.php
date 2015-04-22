<?php

namespace Siox\Db\Schema;

use Siox\Db\Constraint\PrimaryKey;

class AbstractTableFactory
{
    protected $schema;
    protected $tableObj;
    protected $current;
    
    public function __construct($schema,$table)
    {
        $this->tableObj = $table;
        $this->schema = $schema;
    }
        
    public function __get($attr)
    {
        if($attr == 'column') {
            return new ColumnFactory($this->schema, $this->tableObj);
        }
        elseif($attr == 'constraint') {
            return new ConstraintFactory($this->schema, $this->tableObj);   
        }
        elseif($attr == 'table') {
			return  new TableFactory($this->schema, $this->tableObj);
		}
        return null;
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
		if(isset($this->current)) {
	        $this->current->setComment($comment);		
		}
		else {
			$this->tableObj->setComment($comment);
		}
		return $this;
	}
}
