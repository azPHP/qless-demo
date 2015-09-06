#!/usr/bin/env php
<?php
require_once './vendor/contatta/qless-php/lib/Qless/Worker.php';
require_once './vendor/contatta/qless-php/lib/Qless/Queue.php';
require_once './vendor/contatta/qless-php/lib/Qless/Client.php';
$config = require(__DIR__.'/config.php');
$client = new \Qless\Client($config['redis']['host']);
$worker = new \Qless\Worker('MyWorker', ['demo'], $client, 30);

$worker->run();
