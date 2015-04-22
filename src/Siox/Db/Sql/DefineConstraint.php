<?php

namespace Siox\Db\Sql;

use Siox\Db\Constraint;

class DefineConstraint extends Base implements SqlInterface
{
	protected $constraint;

	public function setConstraint($constraint)
	{
		$this->constraint = $constraint;
	}

    public function getSqlString()
    {
	    if($this->constraint instanceof Constraint\PrimaryKey) {
			return $this->getPlatform()->formatPrimaryKey($this->constraint);
		}
		elseif($this->constraint instanceof Constraint\UniqueKey) {
			return $this->getPlatform()->formatUniqueKey($this->constraint);
		}
	}
}
