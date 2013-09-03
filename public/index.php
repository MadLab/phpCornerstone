<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir('../');
$path = getcwd();

require 'vendor/autoload.php';


$cs = \MadLab\Cornerstone\App::getInstance($path);

//$template = new \MadLab\Cornerstone\TemplateManager\Smarty();
//$cs->setTemplateManager($template);
//$cs->addDependancy('Database', 'DB Class');

$cs->run();


