<?php

require __DIR__ . '/../setup.php';

plan(2);

$schema = new Siox\Db\Schema;

isa_ok($schema->getType('varchar'),'Siox\Db\DataType\Varchar','type varchar');

$schema->type('id')->int->size(14);
$schema->type('word')->varchar->size(128);
$schema->type('uri')->char->size(4095);

isa_ok($schema->getType('id'),'Siox\Db\DataType\Integer','type id => int');

$schema->table('id')
       ->column->id('id')
       ->constraint->pk('id');

$schema->table('concept')
       ->column->id('id')->word('concept')
       ->constraint->pk('id')->unique('concept');    

$schema->table('term')
       ->column->id('id')->word('word')
       ->constraint->pk('id');

$schema->table('description')
       ->column->id('id')->text('text')
       ->constraint->pk('id');

$schema->table('note')
       ->column->id('id')->text('text')
       ->constraint->pk('id');

$schema->table('spo')
        ->column->id('id')->id('s')->id('p')->id('o')
        ->constraint->pk('id');
            
$schema->table('identifier')
       ->column->id('id')->uri('uri')
       ->constraint->pk('id')->unique('uri');

$schema->table('occurence')
       ->column->id('id')->uri('uri')
       ->constraint->pk('id');

