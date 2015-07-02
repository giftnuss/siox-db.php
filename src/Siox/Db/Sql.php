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
        return $this->buildCreateTable($table)->exec();
    }

    public function insert($table, $data)
    {
        $sql = $this->buildInsert($table, $data)->exec();
    }

    public function update($table, $data, $condition = null)
    {
        return $this->buildUpdate($table, $data, $condition)->exec();
    }

    public function buildCreateTable($table)
    {
        $sql = new Sql\CreateTable($this);
        $sql->setTable($table);

        return $sql;
    }

    public function buildInsert($table, $data)
    {
        $sql = new Sql\Insert($this);
        if ($table instanceof Table) {
            $sql->setTable($table);
        } else {
            $sql->setTableByName($table);
        }

        return $sql->build($data);
    }

    public function buildUpdate($table, $data, $condition = null)
    {
        $update = new Sql\Update($this);
        if ($table instanceof Table) {
            $update->setTable($table);
        } else {
            $update->setTableByName($table);
        }

        return $update->build($data);
    }
}
