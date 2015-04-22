<?php

namespace Siox\Db\Platform;

class Sqlite extends Base
{
	public function listTableNames()
	{
        $sql = 'SELECT "name" FROM sqlite_master' .
            ' WHERE "type" LIKE \'table\' AND ' .
            '"name" NOT LIKE \'sqlite_%\'';
        return $this->db->fetchColumn($sql);
    }
    
    public function getQuoteIdentifierSymbol()
    {
        return '"';
    }

    public function quoteIdentifier($identifier)
    {
        return '"' . str_replace('"', '\\' . '"', $identifier) . '"';
    }

    public function quoteIdentifierChain($identifierChain)
    {
        $identifierChain = str_replace('"', '\\"', $identifierChain);
        if (is_array($identifierChain)) {
            $identifierChain = implode('"."', $identifierChain);
        }
        return '"' . $identifierChain . '"';
    }

}
