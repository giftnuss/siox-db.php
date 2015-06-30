<?php

require __DIR__ . '/../setup.php';

plan(3);

$schema = new Siox\Db\Schema('test_schema');
$schema->withDefaultTypes();

ok($id = $schema->getType('id'),'id');
ok($word = $schema->getType('word'),'word');
ok($token = $schema->getType('token'),'token');
ok($mail = $schema->getType('email'),'email');
