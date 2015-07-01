<?php

namespace Anagrom;

use Siox\Db\Schema as Base;

class Schema extends Base
{
    protected function _construct()
    {
        $this->name = 'anagrom';
        $this->type('id')->int->size(14);
        $this->type('word')->varchar->size(128);
        $this->type('uri')->char->size(4095);

        $this->table('id')
            ->column->id('id')
            ->constraint->pk('id');

        $this->table('concept')
            ->column->id('id')->word('concept')
            ->constraint->pk('id')->unique('concept');

        $this->table('term')
            ->column->id('id')->word('word')
            ->constraint->pk('id');

        $this->table('description')
            ->column->id('id')->text('text')
            ->constraint->pk('id');

        $this->table('note')
            ->column->id('id')->text('text')
            ->constraint->pk('id');

        $this->table('triple')
            ->column->id('id')->id('s')->id('p')->id('o')
            ->constraint->pk('id');

        $this->table('identifier')
            ->column->id('id')->uri('uri')
            ->constraint->pk('id')->unique('uri');

        $this->table('occurence')
            ->column->id('id')->uri('uri')
            ->constraint->pk('id');
    }

    public function loadCoreData($db)
    {
        $model = new Anagrom\Model($db, $this);
        $opposite = $model->concept('is opposite of');
        $model->triple(
            $model->concept('is concept of term'),
            $opposite,
            $model->concept('uses concept')
        );
        $language = $model->concept('in language');
        $german = $model->concept('german');
        $english = $model->concept('english');
    }
}
