<?php

namespace Siox\Db;

class Setup
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function initSchema($schema)
    {
        $db = $this->db;
        foreach ($schema->getTables() as $table) {
            $db->sql()->createTable($table);
        }
    }

    public function update($schema)
    {
        $db = $this->db;
        foreach ($schema->getTables() as $table) {
            try {
                $db->sql()->countRows($table);
            }
            catch(\Exception $e) {
                $db->sql()->createTable($table);
            }
        }
    }
}
