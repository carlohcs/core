<?php

	// @author Carlos Henrique Carvalho de Santana <carlohcs@gmail.com>
	// ==================================================================
	//
	// cli-config.php file example. This file is needeed to run the
	// Doctrine Console in terminal at this vendor.
	// 
	// If you has a custom cli-config.php, you do not need this file
	//
	// ------------------------------------------------------------------
	
	use Doctrine\ORM\Tools\Console\ConsoleRunner;

	/**
	 * IF IS A LARAVEL APPLICATION 
	 * AND USE THE atrauzzi/laravel-doctrine vendor
	 * https://github.com/atrauzzi/laravel-doctrine
	 * ---------------------------
	 * require __DIR__.'/../../vendor/autoload.php';
	 * 
	 * $app = require_once __DIR__.'/bootstrap/app.php';
	 * $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
	 * $kernel->bootstrap();
	 * $app->boot();
	 * $entityManager = $app->make('Doctrine\ORM\EntityManager');
	 */
	
	//Core from this repository
	require __DIR__.'/bootstrap/container.php';

	//Get the entityManager service from container
	$entityManager = $container['entityManager'];

	//Return the console runner
	return ConsoleRunner::createHelperSet($entityManager);