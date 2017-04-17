<?php

require __DIR__ . '/../setup.php';

plan(3);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

isa_ok($db, 'Siox\\Db');

$setup = new Anagrom\Setup($db);
$setup->init();

$model = $setup->getModel();
isa_ok($model->orm, 'Siox\\Db\\Orm', 'orm');
isa_ok($model->orm->table('concept'),'Siox\\Db\\Table','table concept');


$topic = $model->concept('topic');

isa_ok($topic,'Anagrom\\Model');
