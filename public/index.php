<?php

chdir('../');
$path = getcwd();

require 'vendor/autoload.php';

$cornerstone = \MadLab\Cornerstone\Cornerstone::getInstance($path);
$cornerstone->getEnvironment();

$config = new \MadLab\Cornerstone\Components\Config();
$config->loadDirectory('config');

include('bootstrap.php');
include('routes.php');

$cornerstone->run();
