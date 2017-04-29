<?php

namespace Siox;

use PDO;
use Exception;
use Siox\Db\Exception as DbException;

class Db
{
    protected $adapter;
    protected $sql;
    protected $info;
    protected $orm;

    public static $default_driver = 'mysql';
    public static $default_charset = 'UTF8';

    protected $cinfo = array();

    public function __construct()
    {
        $this->info = new Db\Information($this);
        $this->orm = new Db\Orm($this);
    }

    public static function factory(array $args)
    {
        $self = new self();
        $self->initialize($args);
        $self->connect();

        return $self;
    }

    public function initialize($args)
    {
        $this->cinfo = array(
            'driver' => self::$default_driver,
            'charset' => self::$default_charset,
        );

        foreach ($args as $k => $v) {
            $this->cinfo[$k] = $v;
        }
    }

    public function connect()
    {
        $method = '_connect_'.$this->cinfo['driver'];
        if (!method_exists($this, $method)) {
            throw new DbException("Driver '{$this->cinfo['driver']} is not implemented.");
        }
        try {
            $this->$method();
            // sql is not lazy so it is initialized after connect
            $this->sql = new Db\Sql($this);
        } catch (Exception $e) {
            throw new DbException($e->getMessage());
        }
    }

    public function disconnect()
    {
        $con = $this->getConnection();
        if($con instanceof PDO) {
            unset($this->adapter);
        }
        return true;
        //->disconnect();
    }

    public function getConnection()
    {
        return $this->adapter;
    }

    protected function _connect_dsn()
    {
        if (!isset($this->cinfo['username'])) {
            $this->cinfo['username'] = null;
        }
        if (!isset($this->cinfo['password'])) {
            $this->cinfo['password'] = null;
        }
        if (!isset($this->cinfo['options'])) {
            $this->cinfo['options'] = array();
        }
        $this->adapter = new PDO(
            $this->cinfo['dsn'],
            $this->cinfo['username'],
            $this->cinfo['password'],
            $this->cinfo['options']
        );
        $this->adapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function _connect_mysql()
    {
        $host = (isset($this->cinfo['host']) ? $this->cinfo['host'] : 'localhost');
        $data = array(
            'dbname='.$this->cinfo['dbname'],
            'host='.$host,
            'charset='.$this->cinfo['charset'],
        );

        $this->cinfo['dsn'] = 'mysql:'.implode(';', $data);
        $this->_connect_dsn();
    }

    public function exec($sql)
    {
        return $this->getConnection()->exec($sql);
    }

    public function fetchColumn($sql, $args = array(), $col = 0)
    {
        $adapter = $this->getConnection();
        if ($sql instanceof Db\Sql) {
            $sql = $sql->toString();
        }
        $stmt = $adapter->prepare($sql);
        $stmt->execute($args);
        $result = array();
        while (($val = $stmt->fetchColumn($col)) !== false) {
            $result[] = $val;
        }

        return $result;
    }

    public function sql()
    {
        return $this->sql;
    }

    public function info()
    {
        return $this->info;
    }

    public function orm(Db\Schema $schema = null)
    {
        if (null !== $schema) {
            try {
                $this->orm->addSchema($schema);
            } catch (DbException $exp) {
                // ignore multiple !additions
            }
        }

        return $this->orm;
    }
}
