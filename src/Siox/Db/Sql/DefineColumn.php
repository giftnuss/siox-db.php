<?php

namespace Siox\Db\Sql;

class DefineColumn extends Base implements SqlInterface
{
	protected $column;

	public function setColumn($col)
	{
		$this->column = $col;
	}

    public function getSqlString()
    {
		$name = $this->column->getName();
		$type = $this->column->getType();
		$result = array(
		    $this->getPlatform()->quoteIdentifier($name),
		    $this->getPlatform()->getTypeString($type)
		);
		
		$return = join(" ",$result);
		$comment = $this->column->getComment();
		if(isset($comment)) {
			$this->getPlatform()->addColumnComment($return,$comment);
		}
		return $return;
	}
}
