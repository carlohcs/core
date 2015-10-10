<?php

namespace Core\Models\Address\State;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * StateModel
 * ---------------------
 * date 2015-09-17
 * 
 * @ORM\Entity(repositoryClass="Core\Models\Address\State\StateRepository")
 * @ORM\Table(name="states")
 */
class StateModel
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;
	
	/**
	 *
	 * @ORM\Column(name="state", type="string")
	 */
	private $state;

	/**
	 *
	 * @ORM\Column(name="initials", type="string")
	 */
	private $initials;

	// ==================================================================
	//
	// Relationships
	//
	// ------------------------------------------------------------------
	
	/**
     *
     * @ORM\OneToMany(targetEntity="\Core\Models\Address\City\CityModel", mappedBy="state", cascade={"all"})
     */
    private $cities;

	// ==================================================================
	//
	// Getters and Setters
	//
	// ------------------------------------------------------------------


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }

    /**
     * Set id
     * 
     * @param string $id
     *
     * @return StateModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return StateModel
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set initials
     *
     * @param string $initials
     *
     * @return StateModel
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;

        return $this;
    }

    /**
     * Get initials
     *
     * @return string
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * Add city
     *
     * @param \Core\Models\Address\City\CityModel $city
     *
     * @return StateModel
     */
    public function addCity(\Core\Models\Address\City\CityModel $city)
    {
        $this->cities[] = $city;

        return $this;
    }

    /**
     * Remove city
     *
     * @param \Core\Models\Address\City\CityModel $city
     */
    public function removeCity(\Core\Models\Address\City\CityModel $city)
    {
        $this->cities->removeElement($city);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }
}
