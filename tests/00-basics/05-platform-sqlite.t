<?php

require __DIR__ . '/../setup.php';


plan(3);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

$platform = $db->sql()->getPlatform();

is($platform->getDriver()->quoteIdentifier('test\'me'),'`test\'me`','quote identifier');
is($platform->quoteIdentifierChain(array('schema','table','name')),
    '"schema"."table"."name"','identifier chain');
