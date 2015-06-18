<?php

$loader = require realpath(__DIR__.'/../vendor/autoload.php');
#print_r(get_class_methods($loader));
require realpath(__DIR__.'/../vendor/giftnuss/test.php/Test.php');

$baseDir = dirname(__DIR__);

$loader->add('Anagrom\\', array($baseDir.'/sample/anagrom/src'));

$tempdir = __DIR__.'/temp';

if (!is_dir($tempdir)) {
    if (!mkdir($tempdir)) {
        die("$tempdir not created");
    }
}
