<?php

require __DIR__ . '/../setup.php';

plan(7);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

isa_ok($db, 'Siox\\Db');

$schema = new Siox\Db\Schema();
is($schema->getName(),'siox_db_schema','name');

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


$schema->table('id2')
       ->column->int('id')->comment('id column')
       ->text('name')
       ->text('email')
       ->constraint->pk('id')->comment('primary key comment')
       ->unique('name','email')
       ->table->comment('id sequence table');
    
$table = $schema->getTable('test_types');
isa_ok($table,'Siox\\Db\\Table','class table');

$create = $db->sql()->createTable($table);

diag($create->getSqlString());

ok($create->exec(),'exec');

$inform = new \Siox\Db\Information($db);
is_deeply($inform->listTableNames(),
    array('test_types'),'one table');

$create = $db->sql()->createTable($schema->getTable('id2'));

diag($create->getSqlString());
ok($create->exec(),'exec');
is_deeply($inform->listTableNames(),
    array('test_types','id2'),'two tables');
