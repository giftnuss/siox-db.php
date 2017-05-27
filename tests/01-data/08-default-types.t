<?php

require __DIR__ . '/../setup.php';

plan(18);

$schema = new Siox\Db\Schema('test_schema');
$schema->withDefaultTypes();

ok($id = $schema->getType('id'),'id');
ok($word = $schema->getType('word'),'word');
ok($token = $schema->getType('token'),'token');
ok($mail = $schema->getType('email'),'email');
ok($url = $schema->getType('url'),'url');

ok($md5 = $schema->getType('digest_md5'),'md5');
ok($sha1 = $schema->getType('digest_sha1'),'sha1');
ok($sha256 = $schema->getType('digest_sha256'),'sha256');

isa_ok($word,"Siox\Db\DataType\Varchar","correct type");
is($word->size(),32,"correct defaut size");

isa_ok($url,"Siox\Db\DataType\Varchar","correct type");
is($url->size(),1024,"correct defaut size");

// override word size
$word->size(64);
is($word->size(),64,"Now the length is 64");

// redefine url type
$schema->type('url')->text;
ok($url2 = $schema->getType('url'),'url');

isa_ok($url2,"Siox\Db\DataType\Text","correct type");
is($url2->size(),65535,"correct defaut size");

// register url type
$schema->getTypeFactory()->register('url',$url);

$schema->type('uri')->url->size(4096);
ok($uri = $schema->getType('uri'),"uri");
is($uri->size(),4096,'uri size');


