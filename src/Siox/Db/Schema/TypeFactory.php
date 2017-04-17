<?php

namespace Siox\Db\Schema;

use Noray\AliasMap;

class TypeFactory extends AliasMap
{
    protected function _initMap()
    {
        $this->map = array(
            'blob' => 'Siox\Db\DataType\Blob',
            'boolean' => 'Siox\Db\DataType\Boolean',
            'char' => 'Siox\Db\DataType\Char',
            'date' => 'Siox\Db\DataType\Date',
            'decimal' => 'Siox\Db\DataType\Decimal',
            'float' => 'Siox\Db\DataType\FloatingPoint',
            'integer' => 'Siox\Db\DataType\Integer',
            'money' => 'Siox\Db\DataType\Money',
            'text' => 'Siox\Db\DataType\Text',
            'time' => 'Siox\Db\DataType\Time',
            'varchar' => 'Siox\Db\DataType\Varchar',
        );
    }

    protected function _initAliase()
    {
        $this->aliase = array(
            'int' => 'integer',
            'double' => 'float',
        );
    }
}
