<?php

namespace Siox\Db\DataType;

use Noray\Accessor;

class Base
{
    protected $nullable = false;
    protected $default = null;
    
    use Accessor;
    
    public function has($property)
    {
        return property_exists($this,$property);
    }    
}
