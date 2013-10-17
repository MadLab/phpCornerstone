<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir('../');
$path = getcwd();

require 'vendor/autoload.php';


$cs = \MadLab\Cornerstone\App::getInstance($path);

//Detect Environments
/*
$cs->detectEnvironment(array(
    'local'=>'example.local',
    'production'=>'example.com'
));
*/


$twigLoader = new Twig_Loader_Filesystem('pages');
$twig = new Twig_Environment($twigLoader, array(
    'cache' => 'storage/templates',
));
$template = new \MadLab\Cornerstone\Components\TemplateBridges\TwigTemplateBridge($twig);

$cs->setTemplateHandler($template);
$cs->run();


