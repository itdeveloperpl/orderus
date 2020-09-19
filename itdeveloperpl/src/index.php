<?php
/**
 * @author Bartosz Bielecki <bartosz(at)itdeveloper.pl>
 * @copyright (c) 2020 Bartosz Bielecki
 */

if(file_exists('vendor/autoload.php')){
    require 'vendor/autoload.php';
} elseif(file_exists('../../vendor/autoload.php')){
     require '../../vendor/autoload.php';
} else{
    throw new Exception("autoload.php not found");
}
use Symfony\Component\Console\Application;
use itdeveloperpl\Orderus\Command\GameCommand;

$application = new Application();
$command     = new GameCommand();
$application->add($command);
$application->setDefaultCommand($command->getName());
$application->run();
