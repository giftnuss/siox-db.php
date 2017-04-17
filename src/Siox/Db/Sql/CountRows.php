<?php

namespace Siox\Db\Sql;

use SQLBuilder\ArgumentArray;
use SQLBuilder\Universal\Query\SelectQuery;

class CountRows extends Base implements SqlInterface
{
    use QueryTrait;
    use TableTrait;

    public function build()
    {
        $this->args = $args = new ArgumentArray();
        $this->query = $query = new SelectQuery();
        $driver = $this->getPlatform()->getDriver();

        $this->query->from($this->getTable()->getTableName());
        $this->query->select('COUNT(*) As cnt');
        $this->query->where('1=1');

        $this->qstr = $query->toSql($driver, $args);

        return $this;
    }
}
