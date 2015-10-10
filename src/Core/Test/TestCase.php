<?php 

	namespace Core\Test;

	use \PHPUnit_Framework_TestCase as PHPUnit;
	use Doctrine\ORM\Tools\SchemaTool;
	use Faker\Factory as FakerFactory;
    

	class TestCase extends PHPUnit
	{
		protected $container;
		protected $entityManager;
		protected $schemaTool;
		protected $faker;

		public function setUp()
		{
			$this->container = $this->getContainer();
			$this->entityManager = $this->getEntityManager();
			$this->faker = $this->getFaker();
		}

		public function tearDown()
		{

		}

		// ==================================================================
		//
		// Container - IoC
		//
		// ------------------------------------------------------------------
		
		public function getContainer()
		{
			$container = require __DIR__.'/../../../bootstrap/container.php';

			return $container;
		}

		// ==================================================================
		//
		// Storage
		//
		// ------------------------------------------------------------------
		
		/**
		 * Object responsible for persist another objects
		 * 
		 * @return object $entityManager
		 */
		public function getEntityManager()
		{
			if(is_null($this->entityManager))
			{
				$container = $this->getContainer();
				$this->entityManager = $container['entityManager'];
			}

			return $this->entityManager;
		}

		/**
		 * Object responsible for create schemas
		 * 
		 * @return object $schemaTool
		 */
		public function getSchemaTool()
		{
			if(is_null($this->schemaTool))
			{
				$container = $this->getContainer();
				$this->schemaTool = $container['schemaTool'];
			}

			return $this->schemaTool;
		}

		/**
		 * Create the schema in db from Models
		 */
		public function createSchema()
		{
			$schemaTool = $this->getSchemaTool();

			$classes = $this->entityManager->getMetadataFactory()
			->getAllMetadata();
			$schemaTool->createSchema($classes);
		}

		/**
		 * Drop the schemas createds from from Models
		 */
		public function dropSchema()
		{
			$schemaTool = $this->getSchemaTool();

			$classes = $this->entityManager->getMetadataFactory()
			->getAllMetadata();
			$schemaTool->dropSchema($classes);
		}

		// ==================================================================
        //
        // Fake data
        //
        // ------------------------------------------------------------------
        public function getFaker()
        {
            //Faker
            $faker = FakerFactory::create();

            $faker->addProvider(new \Faker\Provider\Lorem($faker));
            $faker->addProvider(new \Faker\Provider\Person($faker));
            $faker->addProvider(new \Faker\Provider\DateTime($faker));
            $faker->addProvider(new \Faker\Provider\Internet($faker));
            $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
            $faker->addProvider(new \Faker\Provider\en_US\PhoneNumber($faker));

            return $faker;
        }

        /**
         * Helper to get a entity repository from Core
         *  
         * @param  string $entityName
         * @return object $repository
         */
        public function getEntityCore($entityName)
        {
        	$entity = "Core\\Models\\$entityName";

        	$repository = $this->entityManager->getRepository($entity);

        	return $repository;
        }
	}