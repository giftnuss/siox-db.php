<?php

namespace Siox\Db\Table;

class Column implements ColumnInterface
{
    protected $table;

    protected $name;
    protected $type;
    protected $comment;

    public function __construct($table, $name = null)
    {
        $this->table = $table;
        if (isset($name)) {
            $this->setName($name);
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }
}
