<?php

require __DIR__ . '/../setup.php';

use_ok('\Siox\Db\Constraint\PrimaryKey');
use_ok('\Siox\Db\Constraint\UniqueKey');

use_ok('\Siox\Db\DataType\Base');
use_ok('\Siox\Db\DataType\Blob');
use_ok('\Siox\Db\DataType\Boolean');
use_ok('\Siox\Db\DataType\Char');
use_ok('\Siox\Db\DataType\Date');
use_ok('\Siox\Db\DataType\Decimal');
use_ok('\Siox\Db\DataType\Float');
use_ok('\Siox\Db\DataType\Integer');
use_ok('\Siox\Db\DataType\Money');
use_ok('\Siox\Db\DataType\Text');
use_ok('\Siox\Db\DataType\Time');
use_ok('\Siox\Db\DataType\Varchar');

use_ok('\Siox\Db\Schema\DefaultTypes');
