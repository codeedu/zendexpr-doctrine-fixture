<?php

ini_set('error_reporting', E_ALL | E_STRICT);

$loader = require __DIR__ . '/../vendor/autoload.php';

if (!isset($loader)) {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

/* @var $loader \Composer\Autoload\ClassLoader */
$loader->addPsr4('CodeEduTest\\', __DIR__.'/CodeEduTest');
$loader->register(true);
unset($loader);