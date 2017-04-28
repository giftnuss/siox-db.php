<?php
/*
 * @author Sebastian Knapp
 * @version 0.1
 */

class ScriptTests extends \PHPUnit_Framework_TestCase
{
    protected $tests;

    protected function setUp()
    {
        $this->tests = array(
            '00-basics' => array(
                '01-load.t',
                '02-sqlite.t',
                '03-table.t',
                '04-sql.t',
                '05-platform-sqlite.t',
                '06-requirements.t'
            ),
            '01-data' => array(
                '01-load.t',
                '02-types.t',
                '03-schema.t',
                '04-sqlite-schema.t',
                '05-type-names.t',
                '06-orm.t',
                '07-sqlite-sql.t',
                '08-default-types.t'
            ),
            '02-anagrom' => array(
                '01-load.t',
                '02-setup.t',
                '03-model.t'
            )
        );
    }

    public function testScripts()
    {
        $base = dirname(__DIR__);
        foreach($this->tests as $dir => $tests) {
            foreach($tests as $script) {
                ob_start();
                include "$base/$dir/$script";
                $out = ob_get_contents();
                ob_end_clean();
                $this->assertNotRegExp('/not ok/',$out,"$dir/$script");
            }
        }
    }
}
