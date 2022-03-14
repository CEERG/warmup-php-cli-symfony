<?php

use Symfony\Component\Console\Application;

use app\commands\GetRandomActivityCommand;
use app\commands\GetRandomActivityWithinPriceRangeCommand;
use app\commands\GetRandomActivityWithTypeCommand;

$application = new Application();

$application->add(new GetRandomActivityCommand());
$application->add(new GetRandomActivityWithinPriceRangeCommand());
$application->add(new GetRandomActivityWithTypeCommand());

$application->run();