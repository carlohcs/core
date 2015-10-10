<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	//Require autoload
	require __DIR__.'/../vendor/autoload.php';

	/*$storage = require __DIR__.'/../config/storage.php';

	use DI\ContainerBuilder;
	
	//Container 
	$containerBuilder = new ContainerBuilder;
	$containerBuilder->addDefinitions(__DIR__.'/../config.php');
	$container = $containerBuilder->build();

	return $container;*/

	use Pimple\Container;

	$container = new Container;

	//Register the DoctrineServiceProvider
	$container->register(new Core\Providers\DoctrineServiceProvider);
	
	return $container;