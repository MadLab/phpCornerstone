<?php


/**
 * Setup Available Dependencies
 *
 */

$container = new \Pimple\Container();
$container['PDO'] = function ($c) {
	return new PDO(getenv('DSN'), getenv('DBUSER'), getenv('DBPASS'), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
};
$container['MySQL'] = function ($c) {
	return MadLab\Cornerstone\Components\DataStores\MySQL\MySQL::getConnection($c['PDO']);
};
$container['User'] = $container->factory(function ($c) {
	return new User($c['MySQL']);
});
$container['Twig'] = function ($c) {
	$loader = new Twig_Loader_Filesystem('Controllers');
	return new Twig_Environment($loader, array(
		'cache' => 'storage/templates',
	));
};

/**
 * Setup Templating Engine
 */

//Smarty
/*
	$smarty = new Smarty();
	$smarty->setTemplateDir('Controllers');
	$smarty->setCompileDir('storage/templates');
	//$smarty->addPluginsDir('libraries/MadLab/Smarty/Plugins');
	//$smarty->registerFilter('output', array('TemplateHook', 'parseTemplate'));
	$template = new \MadLab\Cornerstone\Components\TemplateBridges\SmartyTemplateBridge($smarty);
*/

// Twig
$loader = new Twig_Loader_Filesystem('Controllers');
$twig = new Twig_Environment($loader, array(
	'cache' => 'storage/templates',
	'debug' => true
));
$template = new \MadLab\Cornerstone\Components\TemplateBridges\TwigTemplateBridge($twig);


$cornerstone->setDIContainer($container);
$cornerstone->setTemplateEngine($template);
