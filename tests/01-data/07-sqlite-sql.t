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

$schema = new Siox\Db\Schema();
$defaults = new Siox\Db\Schema\DefaultTypes;
$defaults->defaultTypes($schema);

$schema->table('test_sql')->column
    ->int('id')
    ->word('name')
    ->constraint->pk('id');
    
$create = $sql->buildCreateTable($schema->getTable('test_sql'));
isa_ok($create, 'Siox\\Db\\Sql\\CreateTable');

diag($create->getSqlString());
ok($create->exec(),'create table exec');

$insert = $sql->buildInsert('test_sql',array('name' => 'Wolf'));
isa_ok($insert, 'Siox\\Db\\Sql\\Insert');

diag($insert->getSqlString());
ok($insert->exec(),'insert exec');
