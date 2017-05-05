<?php

namespace Siox\Db\Table;

use Siox\Db\Table;
use SQLBuilder\Bind;

class Query
{
    protected $db;
    protected $sql;
    protected $table;

    public function __construct(\Siox\Db $db, Table $table)
    {
        $this->db = $db;
        $this->sql = $db->sql();
        $this->table = $table;
    }

    protected function _prepareSelect($select,$args)
    {
        foreach($args as $k => $v) {
            if(is_array($v)) {
                $select->where()->in($k,$v);
            }
            else {
                $select->where()->equal($k,new Bind($k,$v));
            }
        }
    }


    public function search(array $args,callable $func)
    {
        $select = $this->sql->select($this->table);
        $this->_prepareSelect($select,$args);

        if($this->sql->doQuery($select,$cursor)) {
            $cursor->setFetchMode(\PDO::FETCH_NAMED);
            while($row = $cursor->fetch()) {
                $func($row);
            }
        }
    }

    public function if_not(array $args,callable $func,callable $else=null)
    {
        $select = $this->sql->select($this->table);
        $this->_prepareSelect($select,$args);

        if($this->sql->doQuery($select,$cursor)) {
            if($row = $cursor->fetch(\PDO::FETCH_NAMED)) {
                if($else !== null) {
                    $else($row);
                }
                $cursor->closeCursor();
            }
            else {
                $func($this->sql,$this->table);
            }
        }
    }

}
