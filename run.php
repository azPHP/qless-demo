#!/usr/bin/env php
<?php
require __DIR__.'/vendor/autoload.php';

$app = new \Symfony\Component\Console\Application();
$app->add(new \B2k\QlessDemo\Command\QlessStatusCommand());
$app->add(new \B2k\QlessDemo\Command\AddJobCommand());

$app->run();
