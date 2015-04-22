<?php

namespace Siox\Db\Platform;

class Base
{
	protected $db;
	
    public function __construct($db)
    {
	    $this->db = $db;	
	}
	
	public function listTableNames()
	{
		return array();
	}
	
	public function getTypeString($type)
	{
		$typename = $type->name();
		$result = '';
		if($typename) {
			$result .= $typename;
		}
		if($type->has('size')) {
		    $size = $type->size();
		    if(isset($size)) {
		        $result .= '(' . $size . ')';	
		    }
		}
		if(!$type->nullable()) {
		    $result .= " NOT NULL";	
		}
		
		return $result;
	}
}
