<?php

require __DIR__ . '/../setup.php';

use_ok('Siox\\Db');
use_ok('Siox\\Db\\Exception');

use_ok('Siox\\Db\\Information');
use_ok('Siox\\Db\\Information\\PlatformFactory');

use_ok('Siox\\Db\\Platform\\Base');
use_ok('Siox\\Db\\Platform\\Sqlite');

use_ok('Siox\\Db\\Schema');
use_ok('Siox\\Db\\Schema\\ColumnFactory');
use_ok('Siox\\Db\\Schema\\ConstraintFactory');
use_ok('Siox\\Db\\Schema\\Exception');
use_ok('Siox\\Db\\Schema\\TypeContainer');
use_ok('Siox\\Db\\Schema\\TypeFactory');

use_ok('Siox\\Db\\Sql');
use_ok('Siox\\Db\\Sql\\Base');
use_ok('Siox\\Db\\Sql\\Exception');
use_ok('Siox\\Db\\Sql\\CreateTable');
use_ok('Siox\\Db\\Sql\\DefineColumn');
use_ok('Siox\\Db\\Sql\\DefineConstraint');
#interface_ok('Siox\\Db\\Sql\\SqlInterface');

use_ok('Siox\\Db\\Table');
use_ok('Siox\\Db\\Table\\Column');
use_ok('Siox\\Db\\Table\\Row');

use_ok('Siox\\Db\\Orm');
