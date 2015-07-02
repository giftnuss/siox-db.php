<?php

require __DIR__ . '/../setup.php';

plan(1);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

isa_ok($db, 'Siox\\Db');

$setup = new Anagrom\Setup($db);
$setup->init();

$model = $setup->getModel();

$topic = $model->concept('topic');

isa_ok($topic,'Anagrom\\Model');
