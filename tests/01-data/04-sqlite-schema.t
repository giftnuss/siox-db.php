<?php

require __DIR__ . '/../setup.php';

plan(3);

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
    ->varchar('varchar');
    
$table = $schema->getTable('test_types');
isa_ok($table,'Siox\\Db\\Table','class table');

$create = $db->sql()->createTable($table);

echo $create->getSqlString();
