<?php

require __DIR__ . '/../setup.php';

plan(4);

$table = new \Siox\Db\Table('test');

is($table->getName(),'test','name');
is_deeply($table->getConstraints(),array(),'empty constaints');
is_deeply($table->getColumns(),array(),'empty columns');

$column = new \Siox\Db\Table\Column($table, 'one');

$table->addColumn($column);
is(count($table->getColumns()),1,"one");
is_deeply($table->getColumnNames(),array('one'),'method getColumnNames');
