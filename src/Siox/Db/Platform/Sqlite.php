<?php

namespace Siox\Db\Platform;

class Sqlite extends Base
{
    public function getPlatformTypename($type)
    {
        $typename = $type->name();
        switch ($typename) {
            case 'BOOLEAN':
            case 'TIMESTAMP':  # unix epoch
            case 'INTEGER':
                return 'INTEGER';
            case 'FLOAT':
                return 'FLOAT';
            case 'DATE':
                return 'FLOAT'; # julian date
            case 'DECIMAL':
                return 'NUMERIC';
            case 'CHAR':
            case 'VARCHAR':
            case 'TEXT':
                return 'TEXT';
            default:
                return 'BLOB';
        }
    }

    public function getPlatformTypeSize($type)
    {
        if ($type->has('size')) {
            if ($this->getPlatformTypename($type) == 'INTEGER') {
                return null;
            }

            return $type->size();
        }
    }

    public function listTableNames()
    {
        $sql = 'SELECT "name" FROM sqlite_master'.
            ' WHERE "type" LIKE \'table\' AND '.
            '"name" NOT LIKE \'sqlite_%\'';

        return $this->db->fetchColumn($sql);
    }

    public function getQuoteIdentifierSymbol()
    {
        return '"';
    }

    public function quoteIdentifier($identifier)
    {
        return '"'.str_replace('"', '\\'.'"', $identifier).'"';
    }

    public function quoteIdentifierChain($identifierChain)
    {
        $identifierChain = str_replace('"', '\\"', $identifierChain);
        if (is_array($identifierChain)) {
            $identifierChain = implode('"."', $identifierChain);
        }

        return '"'.$identifierChain.'"';
    }

    public function formatUniqueKey($constraint)
    {
        return sprintf('CONSTRAINT %s UNIQUE (%s)', $constraint->getName(),
            $this->quoteIdentifierList($constraint->getColumns()));
    }
}
