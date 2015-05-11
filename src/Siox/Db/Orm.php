<?php

namespace Siox\Db;

use Noray\AliasMap;

class Orm
{
    protected $db;
    protected $schemas = array();
    protected $tables;
    
    public function __construct($db,$schemas = array())
    {
		$this->db = $db;
		$this->tables = new AliasMap();
		if(!is_array($schemas)) {
			$schemas = array($schemas);
		}
		foreach($schemas as $schema) {
			$this->addSchema($schema);
		}
    }
    
    public function addSchema($schema)
    {
		
	}
}
