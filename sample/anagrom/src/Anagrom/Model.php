<?php

namespace Anagrom;

class Model
{
    protected $db;
    protected $sql;
    protected $schema;
    protected $orm;
    
    public __construct($db,$schema)
    {
        $this->db = $db;
        $this->sql = $db->sql();
        $this->schema = $schema;
        $this->orm = $db->orm($schema);
    }
    
    public function concept($word)
    {
		$this->sql->table($schema->getTable())
	}
	
	public function triple($s,$p,$o)
	{
		
	}
}
