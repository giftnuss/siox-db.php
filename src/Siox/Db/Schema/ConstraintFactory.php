<?php

namespace Siox\Db\Schema;

use Siox\Db\Constraint\UniqueKey;

class ConstraintFactory extends AbstractTableFactory
{
    public function unique()
    {
        $columns = func_get_args();
        $upper = array_map('strtoupper',$columns);
        $name = join('_', $upper) . '_UNIQ';
        $unique = new UniqueKey($columns,$name);
        $this->table->addConstraint($unique);
        return $this;
    }
    
    public function __call($type,$args)
    {
        return $this;
    }
}
