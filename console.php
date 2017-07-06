#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/container.php';

use Symfony\Component\Console\Application;

$application = new Application();
$container = new MyContainer();
$application->add($container->get('worker.command'));
$application->run();