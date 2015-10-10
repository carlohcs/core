<?php

namespace Core\Models\Address\City;

use Doctrine\ORM\Mapping as ORM;

/**
 * CityModel
 * ---------------------
 * date 2015-09-17
 * 
 * @ORM\Entity(repositoryClass="Core\Models\Address\City\CityRepository")
 * @ORM\Table(name="cities")
 */
class CityModel
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;
	
	/**
	 *
	 * @ORM\Column(name="city", type="string")
	 */
	private $city;

	/**
	 *
	 * @ORM\Column(name="state_id", type="integer")
	 */
	private $stateId;

	// ==================================================================
	//
	// Relationships
	//
	// ------------------------------------------------------------------

	/**
     * @ORM\ManyToOne(targetEntity="\Core\Models\Address\State\StateModel", inversedBy="cities")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     *
     */
    private $state;	

	// ==================================================================
	//
	// Getters and Setters
	//
	// ------------------------------------------------------------------

    /**
     * Set id
     * 
     * @param string $id
     *
     * @return CityModel
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
     * Set city
     *
     * @param string $city
     *
     * @return CityModel
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set stateId
     *
     * @param integer $stateId
     *
     * @return CityModel
     */
    public function setStateId($stateId)
    {
        $this->stateId = $stateId;

        return $this;
    }

    /**
     * Get stateId
     *
     * @return integer
     */
    public function getStateId()
    {
        return $this->stateId;
    }

    /**
     * Set state
     *
     * @param \Core\Models\Address\State\StateModel $state
     *
     * @return CityModel
     */
    public function setState(\Core\Models\Address\State\StateModel $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Core\Models\Address\State\StateModel
     */
    public function getState()
    {
        return $this->state;
    }
}
