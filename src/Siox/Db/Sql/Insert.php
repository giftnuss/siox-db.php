<?php

namespace Siox\Db\Sql;

use SQLBuilder\ArgumentArray;
use SQLBuilder\Universal\Query\InsertQuery;
use Siox\Db\Sql\Exception as SqlException;
use Exception as CoreException;

class Insert extends Base implements SqlInterface
{
    use QueryTrait;
    use TableTrait;

    public function build($data)
    {
        $this->args = $args = new ArgumentArray();
        $this->query = $query = new InsertQuery();
        $driver = $this->getPlatform()->getDriver();

        $query->into($this->getTable()->getTableName())
             ->insert($data);

        $this->qstr = $query->toSql($driver, $args);

        return $this;
    }

    public function getSqlString()
    {
        return $this->qstr;
    }

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
