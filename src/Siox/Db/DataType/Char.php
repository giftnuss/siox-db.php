<?php

namespace Siox\Db\DataType;

use Zend\Db\Sql\Ddl\Column;

class Char extends Base
{
	protected $name = 'CHAR';
    protected $size;
}
