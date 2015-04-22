<?php

namespace Siox\Db\Schema;

use Siox\Db\Constraint\PrimaryKey;

class AbstractTableFactory
{
    protected $schema;
    protected $table;
    
    public function __construct($schema,$table)
    {
        $this->table = $table;
        $this->schema = $schema;
    }
        
    public function __get($attr)
    {
        if($attr == 'column') {
            return new ColumnFactory($this->schema, $this->table);
        }
        elseif($attr == 'constraint') {
            return new ConstraintFactory($this->schema, $this->table);   
        }
        return null;
    }

    public function pk()
    {
        $columns = func_get_args();
        $pk = new PrimaryKey($columns);
        $this->table->addConstraint($pk);
        return $this;
    }
}
