<?php

namespace Siox\Db\DataType;

use Zend\Db\Sql\Ddl\Column;

class Varchar extends Base
{
    protected $name = 'VARCHAR';
	
    protected $size = 64;
}
