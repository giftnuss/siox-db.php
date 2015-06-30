<?php

require __DIR__ . '/../setup.php';

plan(7);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

$sql = $db->sql();

isa_ok($db, 'Siox\\Db');
isa_ok($sql, 'Siox\\Db\\Sql');

$schema = new Siox\Db\Schema\Defaults();

$schema->table('test_sql')->column
    ->int('id')->pk()
    ->varchar('name')->size(32);
    
$create = $sql->createTable($schema->getTable('test_sql'));
isa_ok($create, 'Siox\\Db\\Sql\\CreateTable');

diag($create->toSqlString());
ok($create->exec(),'exec');
