<?php

namespace Core\Models\Address;

use Doctrine\ORM\Mapping as ORM;

/**
 * AddressModel
 * ---------------------
 * date 2015-09-17
 * 
 * @ORM\Entity(repositoryClass="Core\Models\Address\AddressRepository")
 * @ORM\Table(name="address")
 */
class AddressModel
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;
	
	/**
	 *
	 * @ORM\Column(name="cep", type="string", nullable=true)
	 */
	private $cep;
	
	/**
	 *
	 * @ORM\Column(name="patio", type="string")
	 */
	private $patio;
	
	/**
	 *
	 * @ORM\Column(name="number", type="string")
	 */
	private $number;
	
	/**
	 *
	 * @ORM\Column(name="complement", type="string", nullable=true)
	 */
	private $complement;
	
	/**
	 *
	 * @ORM\Column(name="neighborhood", type="string")
	 */
	private $neighborhood;
	
	/**
	 *
	 * @ORM\Column(name="city_id", type="integer")
	 */
	private $cityId;
	
	/**
	 *
	 * @ORM\Column(name="state_id", type="integer")
	 */
	private $stateId;
	
	/**
	 *
	 * @ORM\Column(name="account_id", type="integer")
	 */
	private $accountId;
	
	/**
	 *
	 * @ORM\Column(name="created_at", type="datetime")
	 */
	private $createdAt;

	// ==================================================================
	//
	// Relationships
	//
	// ------------------------------------------------------------------
	
	/**
	 * @ORM\ManyToOne(
	 * targetEntity="\Core\Models\Account\AccountModel", inversedBy="address")
	 * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
	 */
	private $account;

    /**
     * @ORM\OneToOne(targetEntity="\Core\Models\Address\State\StateModel")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    private $state;

    /**
     * @ORM\OneToOne(targetEntity="\Core\Models\Address\City\CityModel")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;



	// ==================================================================
	//
	// Getters and setters
	//
	// ------------------------------------------------------------------

    // ==================================================================
    //
    // Constructor
    //
    // ------------------------------------------------------------------
    public function __construct()
    {
        //Set the data
        $this->createdAt = new \DateTime('now');
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
     * Set cep
     *
     * @param string $cep
     *
     * @return AddressModel
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set patio
     *
     * @param string $patio
     *
     * @return AddressModel
     */
    public function setPatio($patio)
    {
        $this->patio = $patio;

        return $this;
    }

    /**
     * Get patio
     *
     * @return string
     */
    public function getPatio()
    {
        return $this->patio;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return AddressModel
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set complement
     *
     * @param string $complement
     *
     * @return AddressModel
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set neighborhood
     *
     * @param string $neighborhood
     *
     * @return AddressModel
     */
    public function setNeighborhood($neighborhood)
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    /**
     * Get neighborhood
     *
     * @return string
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * Set cityId
     *
     * @param integer $cityId
     *
     * @return AddressModel
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;

        return $this;
    }

    /**
     * Get cityId
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set stateId
     *
     * @param integer $stateId
     *
     * @return AddressModel
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
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return AddressModel
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return AddressModel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set account
     *
     * @param \Core\Models\Account\AccountModel $account
     *
     * @return AddressModel
     */
    public function setAccount(\Core\Models\Account\AccountModel $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Core\Models\Account\AccountModel
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set state
     *
     * @param \Core\Models\Address\State\StateModel $state
     *
     * @return AddressModel
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

    /**
     * Set city
     *
     * @param \Core\Models\Address\City\CityModel $city
     *
     * @return AddressModel
     */
    public function setCity(\Core\Models\Address\City\CityModel $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Core\Models\Address\City\CityModel
     */
    public function getCity()
    {
        return $this->city;
    }
}
