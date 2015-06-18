<?php

namespace Siox\Db;

class Information
{
    protected $db;
    protected $platformFactory;
    protected $platform;

    public function __construct($db)
    {
        $this->db = $db;
        $this->platformFactory = new Information\PlatformFactory();
    }

    public function getPlatform()
    {
        if (empty($this->platform)) {
            $platform = $this->getPlatformName();
            $class = $this->platformFactory->get($platform);
            if (!$class) {
                throw new Exception("Platform $platform not implemented yet!");
            }
            $this->platform = new $class($this->db);
        }

        return $this->platform;
    }

    public function getPlatformName()
    {
        $driver = $this->db->getConnection();
        if ($driver instanceof \PDO) {
            return $driver->getAttribute(\PDO::ATTR_DRIVER_NAME);
        }
    }

    public function listTableNames()
    {
        return $this->getPlatform()->listTableNames();
    }
}
