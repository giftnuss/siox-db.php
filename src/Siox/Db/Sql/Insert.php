<?php

namespace Siox\Db\Sql;

use SQLBuilder\ArgumentArray;
use SQLBuilder\Universal\Query\InsertQuery;

class Insert extends Base implements SqlInterface
{
    use QueryTrait;
    use TableTrait;

    public function build($data)
    {
        $this->args = $args = new ArgumentArray();
        $this->query = $query = new InsertQuery();
        $driver = $this->getPlatform()->getDriver();

        $binddata = $this->prepareBind($data);
        $query->into($this->getTable()->getTableName())
             ->insert($binddata);

        $this->qstr = $query->toSql($driver, $args);

        return $this;
    }
}
