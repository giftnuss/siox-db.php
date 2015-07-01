<?php

namespace Siox\Db\Sql;

class Base
{
    protected $sql;

    public function __construct($sql)
    {
        $this->sql = $sql;
    }

    public function getPlatform()
    {
        return $this->sql->getPlatform();
    }
}
