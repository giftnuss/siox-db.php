<?php

namespace Anagrom;

class Model
{
    protected $db;
    protected $sql;
    protected $schema;
    protected $orm;

    public function __construct($db, $schema)
    {
        $this->db = $db;
        $this->sql = $db->sql();
        $this->schema = $schema;
        $this->orm = $db->orm($schema);
    }

    public function concept($word)
    {
		$it = $this->orm->table('id');
        $ct = $this->orm->table('concept');
        $ct->is_not($word,function () use ($it,$ct) {
			
		});
    }

    public function triple($s, $p, $o)
    {
    }
}
