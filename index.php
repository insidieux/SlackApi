<?php
$rootDirectory = realpath(__DIR__);
$autoloadFile = $rootDirectory . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
require_once $autoloadFile;

$loader = new \Composer\Autoload\ClassLoader();
$loader->register();



try {

} catch (SlackApi\Exceptions\ClientException $exception){
    var_dump($exception->getPrevious()->getTrace());
}