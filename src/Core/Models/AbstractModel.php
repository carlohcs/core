<?php namespace Core\Models;

	//Uses
	use Doctrine\ORM\EntityRepository;
	use Doctrine\ORM\Query;
	use Doctrine\ORM\Tools\Pagination\Paginator;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\ORM\Mapping as ORM;

	class AbstractModel extends EntityRepository
	{

	    // ==================================================================
	    //
	    // Getters
	    //
	    // ------------------------------------------------------------------
	    
	    /**
	     * Return the vendor core name
	     * 
	     * @return $string
	     */
		public function getCoreBaseName()
		{
			return "Core\Models\\";
		}

	    /**
		 * Return the entity repository
		 * 
		 * @return object $data
		 */
		public function getEntityRepository($entityName = 'default')
		{
			$entityName = $entityName === 'default' ? $this->getEntityName() : $entityName;

			$repository = $this->getEntityManager()
			->getRepository($entityName);

	        return $repository;
		}

		/**
		 * Return new instance from the entity repository
		 * 
		 * @return object DoctrineInstance
		 */
		public function getNewEntityRepository()
		{
			$entityName = $this->getEntityName();
			
			$repository = new $entityName;

	        return $repository;	
		}

		/**
		 * Return a row
		 * 
		 * @param  integer $id
		 * @return object $data
		 */
		public function get($id)
		{
			$data = $this->getEntityManager()->find($this->getEntityName(), $id);

	        return $data;
		}

		/**
		 * Return a row
		 * 
		 * @return object $data
		 */
		public function getAll()
		{	
			//$toArray = $toArray ? Query::HYDRATE_SINGLE_SCALAR : null;

			$data = $this->getEntityRepository()
				->findAll();

	        return $data;
		}

		/**
		 * Get all from entity in array mode
		 * 
		 * @return $array
		 */
		public function getAllArray()
		{
			$query = $this->getEntityManager()
			->createQuery("SELECT o FROM {$this->getEntityName()} o");
			
			$data = $query->getResult(Query::HYDRATE_SCALAR);
		
			return $data;
		}

		/**
		 * Paginator
		 * 
		 * @param  [type]  $dql         [description]
		 * @param  integer $pageSize    [description]
		 * @param  integer $currentPage [description]
		 * @return [type]               [description]
		 */
		public function paginate($dql, $pageSize = 10, $currentPage = 1)
		{
		    $dql
		        ->setFirstResult($pageSize * ($currentPage - 1)) // set the offset
		        ->setMaxResults($pageSize); // set the limit
		 
		    $paginator = new Paginator($dql);
		    
		    return $paginator;
		}

		/**
		 * Get all from entity in array mode
		 * 
		 * @return $array
		 */
		public function getAllArrayWithPagination($pageSize = 10, $currentPage = 1, $orderBy = 'ASC')
		{
			
			$query = $this->getEntityManager()
			->createQuery("SELECT o FROM {$this->getEntityName()} o ORDER BY o.id {$orderBy}")
			->setHydrationMode(Query::HYDRATE_ARRAY);
			//->orderBy('id', $order);
			
			//HYDRATE_ARRAY -> Generate 'o_property' -> Could iterator better
			//HYDRATE_SCALAR -> Generate 'o_property'
			//$data = $query->getResult(Query::HYDRATE_SCALAR);
			
			$data = $this->paginate($query, $pageSize, $currentPage);

			$totalItems = $data->count();
    		
    		$pagesCount = ceil($totalItems / $data->getQuery()->getMaxResults());

			return array(
				'data' => $this->toArrayWithoutO($data),
				'paginator' => array(
					'totalItems' => $totalItems,
					'pagesCount' => $pagesCount
				)
			);
		}

		// ==================================================================
		//
		// Persists
		//
		// ------------------------------------------------------------------
		
		public function saveEntity($entity)
		{
			$em = $this->getEntityManager();

			$save = false;

			try {
				
				$em->persist($entity);
				$em->flush();
				
				$save = $entity;
			}
			catch ( Doctrine_Connection_Exception $e )
	        {
	        }

	        return $save;
	    } 

		// ==================================================================
		//
		// Helpers
		//
		// ------------------------------------------------------------------
		
		/**
		 * Return data without 'o_' prefix from getAll method
		 * 
		 * @return array
		 */
		public function toArrayWithoutO($data)
		{
			//Replace Method  
    		$replaceArrayOName = function($arr){

	    		$newArray = array();

	    		foreach($arr as $key => $value){
	    			$newArray[str_replace('o_', '', $key)] = $value;
	    		}

	    		return $newArray;
	    	};

	    	$replaceObjectOName = function($objs){

	    		$newArray = array();

	    		foreach($objs as $obj => $arr)
				{
				    $newArray[] = $arr;
				}
	    		
	    		return $newArray;
	    	};

			if(is_array($data)){

				$newData = array_map($replaceArrayOName, $data);

			}
			else if(is_object($data)){

				$newData = $replaceObjectOName($data);

			}

    		return $newData;
		}

		/**
		 * Return a persist object entity
		 * 
		 * @param  array $data
		 * @return Object $repository
		 */
		public function getEntityPersistObject($data)
		{
			$id = isset($data['id']) ? $data['id'] : null;

			$repository = null;

			if(!is_null($id))
			{
				$repository = $this->getEntityRepository()->get($id);
			}
			else
				$repository = $this->getNewEntityRepository();

			return $repository;
		}
	}