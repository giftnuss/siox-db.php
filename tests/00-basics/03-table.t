<?php

require __DIR__ . '/../setup.php';

plan(2);

$table = new \Siox\Db\Table('test');

is($table->getName(),'test','name');

$column = new \Siox\Db\Table\Column('one');

$table->addColumn($column);
is(count($table->getColumns()),1,"one");
