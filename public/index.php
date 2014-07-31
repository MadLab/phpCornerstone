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

$smarty = new Smarty();
$smarty->setTemplateDir('pages');
$smarty->setCompileDir('storage/templates');
$smarty->registerClass('App', '\MadLab\Cornerstone\App');

$template = new \MadLab\Cornerstone\Components\TemplateBridges\SmartyTemplateBridge($smarty);

$cs->setTemplateHandler($template);

include('bootstrap.php');

$cs->run();


