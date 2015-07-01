<?php

namespace Siox\Db\Platform;

class Base
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
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
        foreach ($identifierList as $col) {
            $list[] = $this->quoteIdentifier($col);
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
