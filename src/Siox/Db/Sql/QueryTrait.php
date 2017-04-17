<?php

namespace Siox\Db\Sql;

use Exception as CoreException;
use Siox\Db\Sql\Exception as SqlException;

use SQLBuilder\Bind;

trait QueryTrait
{
    protected $args;
    protected $query;
    protected $qstr;

    public function prepareBind($data)
    {
        $bd = array();
        foreach ($data as $k => $v) {
            if (is_object($v)) {
                $bd[$k] = $v;
            } else {
                $bd[$k] = new Bind($k, $v);
            }
        }

        return $bd;
    }

    public function getSqlString()
    {
        return $this->qstr;
    }

    public function getBindArgs()
    {
        return $this->args->getArgs();
    }

    public function exec()
    {
        try {
            return $this->sql->doQuery($this);
        } catch (CoreException $e) {
            throw new SqlException($e->getMessage());
        }
    }
}
