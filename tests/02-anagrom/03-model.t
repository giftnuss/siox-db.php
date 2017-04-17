<?php

require __DIR__ . '/../setup.php';

plan(4);

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

# is this wanted?
ok($topic > 0,"return id");
