<?php

namespace Siox\Db\Platform;

abstract class Base
{
    protected $db;
    protected $driver;

    public function __construct($db)
    {
        $this->db = $db;
        $this->resetDriver();
    }

    abstract protected function resetDriver();

    public function getDriver()
    {
        return $this->driver;
    }

    public function listTableNames()
    {
        return array();
    }

    public function getTypeString($type)
    {
        $result = $this->getPlatformTypename($type);
        $size = $this->getPlatformTypeSize($type);

        if (isset($size)) {
            $result .= '('.$size.')';
        }
        if (!$type->nullable()) {
            $result .= ' NOT NULL';
        }

        return $result;
    }

    public function getPlatformTypename($type)
    {
        return $type->name();
    }

    public function getPlatformTypeSize($type)
    {
        if ($type->has('size')) {
            return $type->size();
        }
    }

    public function quoteIdentifierList($identifierList)
    {
        $driver = $this->getDriver();
        $list = array();
        foreach ($identifierList as $col) {
            $list[] = $driver->quoteIdentifier($col);
        }

        return implode(',', $list);
    }

    public function formatComment($comment)
    {
        return ' -- '.str_replace("\n", "\n-- ", $comment);
    }

    public function addColumnComment(&$return, $comment)
    {
        $return = $this->formatComment($comment)."\n    ".$return;
    }

    public function formatPrimaryKey($constraint)
    {
        return sprintf('PRIMARY KEY (%s)',
            $this->quoteIdentifierList($constraint->getColumns()));
    }
}
