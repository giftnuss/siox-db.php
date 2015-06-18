<?php

namespace Siox\Db;

use Noray\AliasMap;
use Siox\Db\Exception as DbException;

class Orm
{
    protected $db;
    protected $schemas = array();
    protected $tables;

    public function __construct($db, $schemas = array())
    {
        $this->db = $db;
        $this->tables = new AliasMap();
        if (!is_array($schemas)) {
            $schemas = array($schemas);
        }
        foreach ($schemas as $schema) {
            $this->addSchema($schema);
        }
    }

    public function addSchema($schema)
    {
        $name = $schema->getName();
        if (isset($this->schemas[$name])) {
            throw new DbException("Schema name $name is not unique.");
        }
        $this->schemas[$name] = $schema;

        return $this;
    }
}
