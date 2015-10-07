<?php

	return [
	    'entityManager' => function($c){
	    	return (new Carlohcs\Core\Providers\DoctrineServiceProvider())->registerEntityManager();
	    },
	    'schemaTool' => function($c){
	    	return (new Carlohcs\Core\Providers\DoctrineServiceProvider())->registerSchemaTool();
	    }
	];

	/*DI\object(Carlohcs\Core\Providers\DoctrineServiceProvider::class)
	    	->constructor()
	    	->method('register', $GLOBALS['storage'])*/