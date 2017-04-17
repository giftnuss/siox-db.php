<?php

namespace Siox\Db\Sql;

use SQLBuilder\ArgumentArray;
use SQLBuilder\Universal\Query\SelectQuery;

class Select extends Base implements SqlInterface
{

    use TableTrait;
    
    protected $args;
    protected $query;
    protected $selection = array('*');
    
    public function __construct($sql)
    {
        parent::__construct($sql);
        $this->args = new ArgumentArray;
        $this->query = new SelectQuery();
    }
    
    public function setSelection($sel)
    {
        $this->selection = $sel;
        return $this;
    }
   
    public function getSqlString()
    {
        $this->query->from($this->table->getTableName());
        if($this->selection) {
            $this->query->select($this->selection);
        }
        
        $driver = $this->getPlatform()->getDriver();
        return $this->query->toSql($driver,$this->args);
    }
    
    public function __call(string $name , array $args)
    {
        return call_user_func_array(array($this->query, $name),$args);        
    }
}
