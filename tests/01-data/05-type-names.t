<?php

require __DIR__ . '/../setup.php';

plan(2);

$schema = new Siox\Db\Schema;


is($schema->getType('boolean')->name(),'BOOLEAN','boolean');
is($schema->getType('blob')->name(),'BLOB','blob');
is($schema->getType('char')->name(),'CHAR','char');
is($schema->getType('date')->name(),'DATE','date');
is($schema->getType('decimal')->name(),'DECIMAL','decimal');
is($schema->getType('double')->name(),'FLOAT','float');
is($schema->getType('float')->name(),'FLOAT','float');
is($schema->getType('int')->name(),'INTEGER','int');
is($schema->getType('integer')->name(),'INTEGER','integer');
is($schema->getType('varchar')->name(),'VARCHAR','varchar');
