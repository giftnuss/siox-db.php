<?php

namespace Siox\Db\Schema;

class DefaultTypes
{
    public function defaultTypes(\Siox\Db\Schema $s)
    {
        $s->type('id')->int->size(10);
        $s->type('word')->varchar->size(32);
        $s->type('token')->char->size(128);
        $s->type('email')->varchar->size(255);

        $s->type('digest_md5')->char->size(32);
        $s->type('digest_sha1')->char->size(40);
    }
}
