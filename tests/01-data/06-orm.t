<?php

require __DIR__ . '/../setup.php';

plan(12);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

isa_ok($db, 'Siox\\Db');

$schemas = array(new Siox\Db\Schema(), new Siox\Db\Schema());
try {
    $orm = new Siox\Db\Orm($db, $schemas);
    ok(false,"allow not unique schema");
}
catch(Siox\Db\Exception $e) {
	ok(true, "exception: {$e->getMessage()}");
}


$schema = new Siox\Db\Schema();
$schema->table('test_sql')->column
    ->int('id')
    ->varchar('name')
    ->float('created')
    ->constraint->pk('id');

try {
    $orm = $db->orm($schema);
    ok(true,"one schema is ok");
}
catch(Siox\Db\Exception $e) {
	ok(false, "ups, exception: {$e->getMessage()}");
}

$create = $db->sql()->buildCreateTable($schema->getTable('test_sql'));
isa_ok($create, 'Siox\\Db\\Sql\\CreateTable');

#diag($create->getSqlString());
ok($create->exec(),'create table exec');

$batchdata = array(
     array('Chris',0.45),
     array('Mona',9.78),
     array('Louisa',7.67)
);

$batch = $db->sql()->batchInsert('test_sql',['name','created'],$batchdata);

$check = function ($row) {
    is($row['name'],'Mona','correct name');
    is($row['created'],9.78,'correct created');
};
$orm->query('test_sql')->search(array('name' => 'Mona'),$check);

$table = $orm->table('test_sql');
isa_ok($table,'Siox\\Db\\Table','table');

is_deeply($table->getColumnNames(),array('id','name','created'),'columns');

$insertjoe = function ($sql,$table) {
    $sql->insert($table,array('name' => 'Joe','created' => '4.23'));
};
$orm->query($table)->if_not(array('name' => 'Joe'),$insertjoe);


$check = function ($row) {
    is($row['name'],'Joe','correct name');
    is($row['created'],4.23,'correct created');
};
$orm->query('test_sql')->search(array('name' => 'Joe'),$check);

ok(true,"Finish");

