<?php

require __DIR__ . '/../setup.php';


plan(3);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

$sql = $db->sql();

isa_ok($sql,'Siox\\Db\\Sql','Sql');
isa_ok($sql->getDb(),'Siox\\Db','Db');
isa_ok($sql->getPlatform(),'Siox\Db\Platform\Sqlite','Platform');
