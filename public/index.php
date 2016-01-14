<?php

chdir('../');
$path = getcwd();

require 'vendor/autoload.php';

$cornerstone = \MadLab\Cornerstone\Cornerstone::getInstance($path);
$cornerstone->getEnvironment(['DSN']);

include('bootstrap.php');
include('routes.php');

$cornerstone->run();
