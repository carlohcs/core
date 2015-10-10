<?php

	namespace Core\Providers;

	use Doctrine\ORM\EntityManager;
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\Tools\SchemaTool;
	use Doctrine\Common\Annotations\AnnotationReader;
	use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

	use Pimple\Container;
	use Pimple\ServiceProviderInterface;
	
	class DoctrineServiceProvider implements ServiceProviderInterface
	{
		/**
		 * Register all services
		 */
		public function register(Container $container)
		{
			$this->registerEntityManager($container);
			
			$this->registerSchemaTool($container);
		}

		/**
		 * Register the EntityManager service - alias -> entityManager
		 * 
		 * @param  Container $container
		 */
		public function registerEntityManager(Container $container)
		{
			$entityManager = $this->getEntityManager();

			$container['entityManager'] = function() use($entityManager) {

				return $entityManager;

			};
		}

		/**
		 * Register the SchemaTool service - alias -> schemaTool
		 * 
		 * @param  Container $container
		 * @return
		 */
		public function registerSchemaTool(Container $container)
		{
			$schemaTool = $this->getSchemaTool();

			$container['schemaTool'] = function() use($schemaTool) {

            	return $schemaTool;

        	};
		}

		public function getEntityManager()
		{
			//ABSTRACT THIS PART
			$coreModelsPath = __DIR__.'/../Models';

			//ABSTRACT THIS PART
			$storage = include __DIR__.'/../../../config/storage.php';

			//path/to/entity-files
			$paths = [
				$coreModelsPath
			];

			//Desability when in production env
			$isDevMode = $storage['isDevMode'];

			// the connection configuration
			$dbParams = [
			    'driver'   => $storage['driver'],
			    'user'     => $storage['username'],
			    'password' => $storage['password'],
			    'dbname'   => $storage['dbname'],
			    'driverOptions' => [
			    	\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
			    ]
			];

			//This add support to @ORM\ instead of @Entity, for example
			$reader = new AnnotationReader();
			$driver = new AnnotationDriver($reader, $paths);

			$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
			$config->setMetadataDriverImpl($driver);

			//Previne o problema de não ter permissão a pasta tmp do sistema
			//Warning: rename(/tmp/ doctrine
			//http://stackoverflow.com/questions/4096034/doctrine-2-auto-generating-proxies
			//$config->setProxyDir(APP_SISTEMA."/application/proxies");

			$entityManager = EntityManager::create($dbParams, $config);

			return $entityManager;
		}

		public function getSchemaTool()
		{
			$entityManager = $this->getEntityManager();

			$schemaTool = new SchemaTool($entityManager);

			return $schemaTool;
		}

		/**
		 * FOR LARAVEL
		 * Set the services of service
		 * 
		 * @return array
		 */
		public function provides()
		{
			return ['entityManager', 'schemaTool'];
		}
	}