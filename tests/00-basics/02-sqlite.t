<?php

require __DIR__ . '/../setup.php';

plan(3);

$db = new \Siox\Db();

$db->initialize(array(
  'driver' => 'dsn',
  'dsn' => 'sqlite::memory:'
));

$db->connect();

isa_ok($db, 'Siox\\Db');

$inform = new \Siox\Db\Information($db);

is($inform->getPlatformName(),'sqlite','sqlite platform');
is(count($inform->listTableNames()),0,'no tables');
