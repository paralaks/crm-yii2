<?php

// Handle server configuration definitons
require (__DIR__ . '/server-configuration.php');

// Once all good, load framework
require (__DIR__ . '/../vendor/autoload.php');
require (__DIR__ . '/Yii.php');

$config=require (__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
