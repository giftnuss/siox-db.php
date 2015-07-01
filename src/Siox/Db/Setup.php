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
            $db->sql()->createTable($table)->exec();
        }
    }
}
