<?php

use Spatie\Ignition\Ignition;

require __DIR__ . '/../vendor/autoload.php';

Ignition::make()
    ->applicationPath(__DIR__ . '/../')
    ->shouldDisplayException(true)
    ->setEditor('vscode')
    ->theme('dark')
    ->runningInProductionEnvironment(false)
    ->register();
