<?php

namespace Siox\Db\Sql;

use Siox\Db\Sql\Exception as SqlException;
use Exception as CoreException;

class Update extends Base implements SqlInterface
{
    protected $table;

    public function exec()
    {
        try {
            $this->sql->getDb()->exec($this->getSqlString());

            return true;
        } catch (CoreException $e) {
            throw new SqlException($e->getMessage());
        }
    }
}
