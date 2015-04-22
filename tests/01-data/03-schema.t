<?php

require __DIR__ . '/../setup.php';

plan(2);

$schema = new Siox\Db\Schema;

isa_ok($schema->getType('varchar'),'Siox\Db\DataType\Varchar','type varchar');

$schema->type('id')->int->size(14);

isa_ok($schema->getType('id'),'Siox\Db\DataType\Integer','type id => int');

$schema->table('id')->comment('id sequence table')
       ->column->id('id')->comment('id column')
       ->constraint->pk('id')->comment('primary key comment');

$schema->table('id2')
       ->column->id('id')->comment('id column')
       ->constraint->pk('id')->comment('primary key comment')
       ->table->comment('id sequence table');
