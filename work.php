#!/usr/bin/env php
<?php
require './vendor/autoload.php';

$config = require(__DIR__.'/config.php');
$client = new \Qless\Client($config['redis']['host']);
$worker = new \Qless\Worker('MyWorker', ['demo'], $client, 10);
$worker->setLogger(new \B2k\QlessDemo\Log\ConsoleLogger());
$q = $client->getQueue('demo');
$q->heartbeat = 5;

$worker->run();
