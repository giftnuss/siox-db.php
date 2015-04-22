<?php

namespace Siox\Db\Sql;

use Exception;
use Siox\Db\Sql\Exception as SqlException;

class CreateTable extends Base implements SqlInterface
{
	protected $table;

    public function exec()
    {
		try {
			$this->sql->getDb()->exec( $this->getSqlString() );
			return true;
		}
		catch(Exception $e) {
			throw new SqlException( $e->getMessage() );
		}
	}

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
