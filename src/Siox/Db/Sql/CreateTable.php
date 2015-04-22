<?php

namespace Siox\Db\Sql;

class CreateTable extends Base implements SqlInterface
{
	protected $table;
	
    public function setTable($table)
    {
		$this->table = $table;
		return $this;
	}
	
	public function getSqlString()
	{
		$platform = $this->getPlatform();
		$sql = 'CREATE TABLE ' . 
		    $platform->quoteIdentifier( $this->table->getName() ) . " (\n    ";
		    
		$result = array();
		foreach($this->table->getColumns() as $col) {
			$column = $this->defineColumn($col);
			$result[] = $column->getSqlString();
		}
		
		$sql .= join(",\n    ",$result);
		$sql .= "\n)";
		return $sql;
	}
	
	public function defineColumn($col)
	{
	    $column = new DefineColumn( $this->sql );
	    $column->setColumn( $col );
	    return $column;
	}
}
