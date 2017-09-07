<?php

include_once __DIR__.'/../vendor/autoload.php';

$classLoader = new \Composer\Autoload\ClassLoader();
$classLoader->addPsr4("gan4x4\\Tests\\", __DIR__."/gan4x4", true);
$classLoader->register();

