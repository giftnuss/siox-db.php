<?php

namespace Siox\Db\Table;

use Siox\Db\Table;

class Query
{
    protected $db;
    protected $sql;
    protected $table;
    
    public function __construct(Siox\Db $db, Table $table)
    {
        $this->db = $db;
        $this->sql = $sql;
        $this->table = $table;
    }
    
    public function search(array $args,callable $func)
    {
        $select = $this->sql->select($this->table);
        
    }

}
