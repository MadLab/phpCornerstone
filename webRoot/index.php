<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_PATH', dirname(dirname(__FILE__)));
define('CORNERSTONE_PATH', ROOT_PATH . '/cornerstone');
define('APP_PATH', ROOT_PATH);
define('STORAGE_PATH', APP_PATH . '/storage/');
define('LIBRARY_PATH', APP_PATH . '/libraries/');
define('HELPER_PATH', APP_PATH . '/helpers/');

define('CONFIG_FILE', APP_PATH . '/conf/conf.loader.php');
define('ROUTES_FILE', APP_PATH . '/routes.php');
define('BOOTSTRAP_FILE', APP_PATH . '/bootstrap.php');
define('CONTROLLER_PATH', APP_PATH . '/pages/');
define('ERROR_PATH', CONTROLLER_PATH . '/errors/');

$path = str_replace('webRoot/index.php', '', $_SERVER['SCRIPT_NAME']);
require CORNERSTONE_PATH . '/cs.php';

$cs = cs::getInstance();
$cs->dispatch();