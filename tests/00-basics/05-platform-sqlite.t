<?php

require __DIR__ . '/../setup.php';


plan(3);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

$platform = $db->sql()->getPlatform();

is($platform->getQuoteIdentifierSymbol(),'"','quote identifier symbol');
is($platform->quoteIdentifier('name'),'"name"','sample');
is($platform->quoteIdentifierChain(array('schema','table','name')),
    '"schema"."table"."name"','identifier chain');
