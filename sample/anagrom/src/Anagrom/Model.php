<?php

namespace Anagrom;

class Model
{
    protected $db;
    protected $sql;
    protected $schema;
    public $orm;

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
        $qr = $this->orm->query($ct);
        $qr->if_not(array('word' => $word),function () use ($it,$ct) {
			
		});
    }

    public function triple($s, $p, $o)
    {
    }
}
