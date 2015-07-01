<?php

namespace Anagrom;

use Siox\Db\Setup as DbSetup;

class Setup
{
    protected $db;
    protected $schema;

    public function __construct($db)
    {
        $this->db = $db;
        $this->schema = new Schema();
    }

    public function init()
    {
        $this->loadSchemaIfRequired();
    }

    protected function loadSchemaIfRequired()
    {
        $tables = $this->db->info()->listTableNames();
        if (count($tables) == 0) {
            $setup = new DbSetup($this->db);
            $setup->initSchema($this->schema);
        }
    }

    public function getModel()
    {
        return new Model($this->db, $this->schema);
    }

    public function getTables()
    {
        return $this->schema->getTables();
    }

    public function getTable($name)
    {
        return $this->schema->getTable($name);
    }
}
