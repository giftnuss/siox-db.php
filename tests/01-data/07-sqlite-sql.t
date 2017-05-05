<?php

require __DIR__ . '/../setup.php';

plan(11);

$db = Siox\Db::factory(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

$sql = $db->sql();

isa_ok($db, 'Siox\\Db');
isa_ok($sql, 'Siox\\Db\\Sql');

$schema = new Siox\Db\Schema();
$defaults = new Siox\Db\Schema\DefaultTypes;
$defaults->defaultTypes($schema);

$schema->table('test_sql')->column
    ->int('id')
    ->word('name')
    ->constraint->pk('id');

$create = $sql->buildCreateTable($schema->getTable('test_sql'));
isa_ok($create, 'Siox\\Db\\Sql\\CreateTable');

diag($create->getSqlString());
ok($create->exec(),'create table exec');

$insert = $sql->buildInsert('test_sql',array('name' => 'Wolf'));
isa_ok($insert, 'Siox\\Db\\Sql\\Insert');

#print_r($insert);

diag($insert->getSqlString());
ok($insert->exec(),'insert exec');

$names = $db->fetchColumn("SELECT * FROM test_sql WHERE 1=1",array(),1);
is_deeply($names,array('Wolf'),'name inserted :)');

$batchdata = array(
     array('Chris'),
     array('Mona'),
     array('Louisa')
);

$batch = $sql->batchInsert('test_sql',['name'],$batchdata);

$expect = array('Wolf');
foreach($batchdata as $r) { $expect[] = $r[0]; }

$names = $db->fetchColumn("SELECT * FROM test_sql WHERE 1=1",array(),1);
is_deeply($names,$expect,'batch insert :)');

$select = $sql->select('test_sql');
isa_ok($select, 'Siox\\Db\\Sql\\Select');

$select->where()->like('name','Wolf');

# getSqlString can be called only one time
#diag($select->getSqlString());

$sql->doQuery($select,$cursor);
ok($cursor->fetch(),'Wolf found');

ok($db->disconnect());

