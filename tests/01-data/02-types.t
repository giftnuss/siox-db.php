<?php

require __DIR__ . '/../setup.php';

$types = new \Siox\Db\Schema\TypeFactory;

is($types->get('blob'),    'Siox\Db\DataType\Blob',   'blob');
is($types->get('boolean'), 'Siox\Db\DataType\Boolean','boolean');
is($types->get('char'),    'Siox\Db\DataType\Char',   'char');
is($types->get('date'),    'Siox\Db\DataType\Date',   'date');
is($types->get('decimal'), 'Siox\Db\DataType\Decimal','decimal');
is($types->get('double'),  'Siox\Db\DataType\FloatingPoint',  'double');
is($types->get('float'),   'Siox\Db\DataType\FloatingPoint',  'float');
is($types->get('int'),     'Siox\Db\DataType\Integer','int');
is($types->get('integer'), 'Siox\Db\DataType\Integer','integer');
is($types->get('money'),   'Siox\Db\DataType\Money',  'money');
is($types->get('text'),    'Siox\Db\DataType\Text',   'text');
is($types->get('time'),    'Siox\Db\DataType\Time',   'time');
is($types->get('varchar'), 'Siox\Db\DataType\Varchar','varchar');

        
