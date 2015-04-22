<?php

namespace Siox\Db\Information;

use Noray\AliasMap;

class PlatformFactory extends AliasMap
{
    protected function _initMap()
    {
        $this->map = array(
            'sqlite'    => 'Siox\Db\Platform\Sqlite'
        );
    }
}

