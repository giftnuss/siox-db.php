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
        $ct = $this->orm->table('concept');
        $qr = $this->orm->query($ct);
        $id = null;
        $it = $this->orm->table('id');
        $qr->if_not(array('concept' => $word),function ($sql,$table) 
            use ($it,$ct,$word,&$id) {
			$sql->insert($it,array('id' => null));
			$id = $sql->lastInsertId('id');
			$sql->insert($ct,array('id' => $id,'concept' => $word));
		}, function ($row) use (&$id) {
			$id = $row['id'];
		});
		return $id;
    }

    public function triple(int $s,int $p,int $o)
    {
		$tr = $this->orm->table('triple');
        $it = $this->orm->table('id');
		$qr = $this->orm->query($tr);
        $id = null;
        $qr->if_not(array('s' => $s,'p' => $p,'o' => $o),
           function ($sql,$table) use ($tr,$it,&$id,$s,$p,$o) {
			  $sql->insert($it,array('id' => null));
			  $id = $sql->lastInsertId('id');
			  $sql->insert($tr,array('id' => $id,'s' => $s,'p' => $p,'o' => $o));
		}, function ($row) use (&$id) {
			$id = $row['id'];
		});
		return $id;
    }
}
