<?php

namespace Core\Models\Telephone;

use Doctrine\ORM\Mapping as ORM;

/**
 * TelephoneModel
 * ---------------------
 * date 2015-09-17
 * 
 * @ORM\Entity(repositoryClass="Core\Models\Telephone\TelephoneRepository")
 * @ORM\Table(name="telephones")
 */
class TelephoneModel
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="telephone", type="string")
	 */
	private $telephone;

	/**
	 * @ORM\Column(name="telephone_area_id", type="integer", nullable=true)
	 */
	private $areaId;

	/**
	 * @ORM\Column(name="telephone_type_id", type="integer", nullable=true)
	 */
	private $typeId;

	/**
	 * @ORM\Column(name="created_at", type="datetime")
	 */
	private $createdAt;

	// ==================================================================
	//
	// Relationships
	//
	// ------------------------------------------------------------------
	
	/**
     * @ORM\ManyToOne(targetEntity="\Core\Models\Account\AccountModel", inversedBy="telephones")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     *
     */
    private $account;

    /**
     * @ORM\OneToOne(targetEntity="\Core\Models\Telephone\TelephoneAreaModel")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    private $area;

    /**
     * @ORM\OneToOne(targetEntity="\Core\Models\Telephone\TelephoneTypeModel")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    // ==================================================================
    //
    // Constructor
    //
    // ------------------------------------------------------------------
    public function __construct()
    {

        //Define the date create
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
     * Set telephone
     *
     * @param string $telephone
     *
     * @return TelephoneModel
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set areaId
     *
     * @param integer $areaId
     *
     * @return TelephoneModel
     */
    public function setAreaId($areaId)
    {
        $this->areaId = $areaId;

        return $this;
    }

    /**
     * Get areaId
     *
     * @return integer
     */
    public function getAreaId()
    {
        return $this->areaId;
    }

    /**
     * Set typeId
     *
     * @param integer $typeId
     *
     * @return TelephoneModel
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TelephoneModel
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
     * @return TelephoneModel
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
     * Set area
     *
     * @param \Core\Models\Telephone\TelephoneAreaModel $area
     *
     * @return TelephoneModel
     */
    public function setArea(\Core\Models\Telephone\TelephoneAreaModel $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \Core\Models\Telephone\TelephoneAreaModel
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set type
     *
     * @param \Core\Models\Telephone\TelephoneTypeModel $type
     *
     * @return TelephoneModel
     */
    public function setType(\Core\Models\Telephone\TelephoneTypeModel $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Core\Models\Telephone\TelephoneTypeModel
     */
    public function getType()
    {
        return $this->type;
    }
}
