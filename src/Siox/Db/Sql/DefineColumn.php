<?php

namespace Siox\Db\Sql;

class DefineColumn extends Base implements SqlInterface
{
    protected $column;

    public function setColumn($col)
    {
        $this->column = $col;
    }

    public function getSqlString()
    {
        $platform = $this->getPlatform();
        $driver = $platform->getDriver();

        $name = $this->column->getName();
        $type = $this->column->getType();
        $result = array(
            $driver->quoteIdentifier($name),
            $platform->getTypeString($type),
        );

        $return = implode(' ', $result);
        $comment = $this->column->getComment();
        if (isset($comment)) {
            $platform->addColumnComment($return, $comment);
        }

        return $return;
    }
}
