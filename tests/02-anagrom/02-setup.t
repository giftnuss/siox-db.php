<?php

require __DIR__ . '/../setup.php';

plan(9);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

isa_ok($db, 'Siox\\Db');

$setup = new Anagrom\Setup($db);
$setup->init();

$tables = $setup->getTables();

foreach($tables as $tab) {
	$name = $tab->getName();
	is($name,$tab->getTableName(),"no prefix for table $name");
	$names[] = $name;
}
sort($names);
$expect = array(
  'concept',
  'description',
  'id',
  'identifier',
  'note',
  'occurence',
  'term',
  'triple'
);
is_deeply($names,$expect,'expected table names');

