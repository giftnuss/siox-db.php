<?php

namespace Siox\Db\Sql;

interface SqlInterface
{
	public function getPlatform();
	
    public function getSqlString();
}
