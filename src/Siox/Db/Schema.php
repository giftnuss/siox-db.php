<?php

namespace Siox\Db;

use Noray\DefaultName;
use Siox\Db\Schema\ColumnFactory;
use Siox\Db\Schema\TypeFactory;
use Siox\Db\Schema\TypeContainer;
use Siox\Db\Schema\DefaultTypes;

class Schema
{
    public $type;

    protected $name;
    protected $prefix = '';
    protected $typeFactory;

    protected $namedTypes = array();
    protected $tables = array();

    use DefaultName;

    public function __construct($name = '')
    {
        if ($name === '') {
            $name = $this->_getDefaultName();
        }
        $this->name = $name;
        $this->type = new TypeContainer($this, '');
        $this->typeFactory = new TypeFactory();
        $this->_construct();
    }

    protected function _construct()
    {
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function type($name = '')
    {
        $name = strtolower($name);
        if (isset($this->namedTypes[$name])) {
            return $this->namedTypes[$name];
        }
        $type = new TypeContainer($this, $name);
        $this->namedTypes[$name] = $type;

        return $type;
    }

    public function getTypeFactory()
    {
        return $this->typeFactory;
    }

    public function getTypeClass($name)
    {
        return $this->typeFactory->get($name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType($name)
    {
        if (isset($this->namedTypes[$name])) {
            return $this->namedTypes[$name]->getType();
        }

        return $this->type->$name;
    }

    public function table($name)
    {
        if (isset($this->tables[$name])) {
            $table = $this->tables[$name];
        } else {
            $table = $this->tables[$name] = new Table($name);
        }

        return new ColumnFactory($this, $table);
    }

    public function getTables()
    {
        return $this->tables;
    }

    public function getTable($name)
    {
        return $this->tables[$name];
    }

    public function withDefaultTypes()
    {
        $default = new DefaultTypes();
        $default->defaultTypes($this);
    }
}
