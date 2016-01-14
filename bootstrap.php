<?php


/**
 * Setup Available Dependencies
 *
 */

$container = new \Pimple\Container();
$container['pdo'] = function ($c) {
	return new PDO(getenv('DSN'), getenv('DBUSER'), getenv('DBPASS'), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
};
$container['User'] = $container->factory(function ($c) {
	return new User($c['pdo']);
});
$container['Twig'] = function ($c) {
	$loader = new Twig_Loader_Filesystem('Controllers');
	return new Twig_Environment($loader, array(
		'cache' => 'storage/templates',
	));
};
$cornerstone->setDIContainer($container);