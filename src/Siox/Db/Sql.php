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
    
    public function lastInsertId(string $sequence=null)
    {
		$adapter = $this->getDb()->getConnection();
	    return $adapter->lastInsertId($sequence);
	}

    public function doQuery(Sql\SqlInterface $sql, &$stmt=null)
    {
        $adapter = $this->getDb()->getConnection();
        $stmt = $adapter->prepare($sql->getSqlString());

        return $stmt->execute($sql->getBindArgs());
    }

    public function createTable($table)
    {
        return $this->buildCreateTable($table)->exec();
    }

    public function insert($table, $data)
    {
        return $this->buildInsert($table, $data)->exec();
    }

    public function batchInsert($table, $cols, $rows)
    {
        $first = reset($rows);
        $build = array_combine($cols, $first);
        $insert = $this->buildInsert($table, $build);
        $adapter = $this->getDb()->getConnection();

        $stmt = $adapter->prepare($insert->getSqlString());
        foreach ($rows as $row) {
            $stmt->execute($row);
        }

        return true;
    }

    public function update($table, $data, $condition = null)
    {
        return $this->buildUpdate($table, $data, $condition)->exec();
    }
    
    public function countRows($table)
    {
		$sql = new Sql\CountRows($this);
		$sql->setTable($table);
		$sql->build();
		
        $adapter = $this->getDb()->getConnection();
        $stmt = $adapter->prepare($sql->getSqlString());
        $stmt->execute();
        if($row = $stmt->fetch(\PDO::FETCH_NAMED)) {
			return $row['cnt'];
		}
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
    
    public function select($table,array $columns = null)
    {
		$sql = new Sql\Select($this);
        if ($table instanceof Table) {
            $sql->setTable($table);
        } else {
            $sql->setTableByName($table);
        }
        if($columns !== null) {
			$sql->setSelection($columns);
		}
        return $sql;
    }

}
