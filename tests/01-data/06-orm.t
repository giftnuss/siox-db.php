<?php

require __DIR__ . '/../setup.php';

plan(2);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

isa_ok($db, 'Siox\\Db');

$schemas = array(new Siox\Db\Schema(), new Siox\Db\Schema());
try {
    $orm = new Siox\Db\Orm($db, $schemas);
    ok(false,"allow not unique schema");
}
catch(Siox\Db\Exception $e) {
	ok(true, "exception: {$e->getMessage()}");
}
