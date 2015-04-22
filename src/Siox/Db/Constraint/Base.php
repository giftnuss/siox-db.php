<?php

namespace Siox\Db\Constraint;

class Base
{
    protected $comment;
    
    public function setComment($comment)
    {
		$this->comment = $comment;
	    return $this;
	}
	
	public function getComment()
	{
		return $this->comment;
	}
}
