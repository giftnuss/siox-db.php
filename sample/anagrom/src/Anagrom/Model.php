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
        $qr->if_not(array('concept' => $word),function ($sql,$table) 
            use ($it,$ct,$word) {
			$sql->insert($it,array('id' => null));
			$id = $sql->lastInsertId('id');
			$sql->insert($ct,array('id' => $id,'concept' => $word));
		});
		return $this;
    }

    public function triple($s, $p, $o)
    {
		# ->column->id('id')->id('s')->id('p')->id('o')
    }
}
