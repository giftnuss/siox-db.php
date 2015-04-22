<?php

require realpath(__DIR__ . '/../vendor/autoload.php');
require realpath(__DIR__ . '/../vendor/giftnuss/test.php/Test.php');

$tempdir = __DIR__ . '/temp';

if(!is_dir($tempdir)) {
    if(!mkdir($tempdir)) {
		die("$tempdir not created");
	}	
}
