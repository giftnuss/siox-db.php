<?php

require __DIR__ . '/../setup.php';

plan(6);

$schema = new Siox\Db\Schema('test_schema');
$schema->withDefaultTypes();

ok($id = $schema->getType('id'),'id');
ok($word = $schema->getType('word'),'word');
ok($token = $schema->getType('token'),'token');
ok($mail = $schema->getType('email'),'email');

ok($md5 = $schema->getType('digest_md5'),'md5');
ok($sha1 = $schema->getType('digest_sha1'),'sha1');
