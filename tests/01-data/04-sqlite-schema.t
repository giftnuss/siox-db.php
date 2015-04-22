<?php

require __DIR__ . '/../setup.php';

plan(4);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

isa_ok($db, 'Siox\\Db');

$schema = new Siox\Db\Schema();

$schema->table('test_types')->column
    ->blob('blob')
    ->boolean('boolean')
    ->char('char')
    ->date('date')
    ->decimal('decimal')
    ->double('double')
    ->float('float')
    ->int('int')
    ->integer('integer')
    ->money('money')
    ->text('text')
    ->time('time')
    ->varchar('varchar')->comment('last column');
    
$table = $schema->getTable('test_types');
isa_ok($table,'Siox\\Db\\Table','class table');

$create = $db->sql()->createTable($table);

diag($create->getSqlString());

ok($create->exec(),'exec');

$inform = new \Siox\Db\Information($db);
is_deeply($inform->listTableNames(),
    array('test_types'),'one table');
