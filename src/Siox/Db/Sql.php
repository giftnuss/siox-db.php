<?php

namespace Siox\Db;

class Sql
{
    protected $db;
    protected $platform;

    public function __construct($db)
    {
        $this->db = $db;
        $info = new Information($db);
        $this->platform = $info->getPlatform();
    }

    public function getDb()
    {
        return $this->db;
    }

    public function getPlatform()
    {
        return $this->platform;
    }

    public function createTable($table)
    {
        $sql = new Sql\CreateTable($this);
        $sql->setTable($table);

        return $sql;
    }

    public function update($table, $data)
    {
        $sql = $this->buildUpdate($table, $data);

        return $sql->exec($data);
    }

    public function buildUpdate($table, $data)
    {
        $update = new Sql\Update($this);
        if ($table instanceof Table) {
            $update->setTable($table);
        } else {
            $update->setTablename($table);
        }

        return $update->build($data);
    }
}
