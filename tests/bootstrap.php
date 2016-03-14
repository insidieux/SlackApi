<?php

$rootDirectory = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');

$autoloadFile = $rootDirectory . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
if (!file_exists($autoloadFile)) {
    throw new RuntimeException('Install dependencies to run test suite.');
}
require_once $autoloadFile;

/*$nsMap = [
    'tests'    => $rootDirectory,
    'SlackApi' => DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . 'src',
];*/

$loader = new \Composer\Autoload\ClassLoader();
$loader->add('tests', $rootDirectory);
$loader->register();
