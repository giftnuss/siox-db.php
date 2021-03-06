<?php

require __DIR__ . '/../setup.php';

plan(8);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

$sql = $db->sql();
$orm = $db->orm();
$schema = new Siox\Db\Schema('test_schema');
$schema->withDefaultTypes();


$schema->table('test_sql')->column
    ->int('id')
    ->word('name')
    ->constraint->pk('id')->unique('name');

$create = $sql->buildCreateTable($schema->getTable('test_sql'));
isa_ok($create, 'Siox\\Db\\Sql\\CreateTable');

diag($create->getSqlString());
ok($create->exec(),'create table exec');

$batchdata = array(
     array('Chris'),
     array('Mona'),
     array('Louisa')
);

$batch = $sql->batchInsert('test_sql',['name'],$batchdata);

$orm->addSchema($schema);
$query = $orm->query('test_sql');

$id1 = 0;
$id2 = -1;

foreach(range(0,1) as $c) {
    $query->if_not(array('name' => 'Wolf'),
        function ($sql,$table) use (&$id1) {
            $sql->insert($table,array('name' => 'Wolf'));
            $id1 = $sql->lastInsertId();
        },
        function ($row) use (&$id2) {
            $id2 = $row['id'];
        });
}
is($id1,$id2,"if_not simple");

$row = $query->pick(['id' => $id1]);
is_deeply($row,['id' => $id1,'name' => 'Wolf'],'simple pick');

try {
    $row = $query->pick(['id' => -9999]);
    ok(false,"Exception when record not found");
}
catch(Exception $e) {
    pass($e->getMessage());
}
$list = [];
$query->search(['name' => ['Louisa','Mona']],
    function ($row) use (&$list) {
        $list[] = $row['name'];
    });
sort($list);
is_deeply($list,['Louisa','Mona'],'test IN query');

is($query->count(['name' => ['Louisa','Mona','Gandalf']]),2,"two rows found");

ok($db->disconnect(),'disconnect');

