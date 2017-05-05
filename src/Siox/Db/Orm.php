<?php

namespace Siox\Db;

use Noray\AliasMap;
use Siox\Db\Exception as DbException;
use Siox\Db\Table;

class Orm
{
    protected $db;
    protected $schemas = array();
    protected $tables;

    public function __construct(\Siox\Db $db, $schemas = array())
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

    public function addSchema(\Siox\Db\Schema $schema)
    {
        $name = $schema->getName();
        if (isset($this->schemas[$name])) {
            throw new DbException("Schema name $name is not unique.");
        }
        $this->schemas[$name] = $schema;

        return $this;
    }

    public function table(string $get)
    {
        if ($table = $this->tables->has($get)) {
            return $this->tables->get($get);
        }
        foreach($this->schemas as $schema) {
            if($table = $schema->getTable($get)) {
                $this->tables->register($get,$table);
                return $table;
            }
        }
    }

    public function query($arg)
    {
        if($arg instanceof Table) {
            $table = $arg;
        }
        else {
            $table = $this->table($arg);
            if(!$table) {
                throw new DbException("Table $arg is unknown.");
            }
        }
        return new Table\Query($this->db,$table);
    }
}
