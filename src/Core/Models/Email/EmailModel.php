<?php

namespace Core\Models\Email;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailModel
 * ---------------------
 * date 2015-09-17
 * 
 * @ORM\Entity(repositoryClass="Core\Models\Email\EmailRepository")
 * @ORM\Table(name="emails")
 */
class EmailModel
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="email", type="string")
	 */
	private $email;

    /**
     * @ORM\Column(name="email_type_id", type="integer", nullable=true)
     */
    private $typeId;

	/**
	 * @ORM\Column(name="account_id", type="integer")
	 */
	private $accountId;

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
     * @ORM\ManyToOne(targetEntity="\Core\Models\Account\AccountModel", inversedBy="emails")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     *
     */
    private $account;

    /**
     * @ORM\OneToOne(targetEntity="\Core\Models\Email\EmailTypeModel")
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

	// ==================================================================
	//
	// Getters and Setters
	//
	// ------------------------------------------------------------------
	
	

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
     * Set email
     *
     * @param string $email
     *
     * @return EmailModel
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return EmailModel
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
     * @return EmailModel
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
     * @return EmailModel
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
     * Set typeId
     *
     * @param integer $typeId
     *
     * @return EmailModel
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
     * Set type
     *
     * @param \Core\Models\Email\EmailTypeModel $type
     *
     * @return EmailModel
     */
    public function setType(\Core\Models\Email\EmailTypeModel $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Core\Models\Email\EmailTypeModel
     */
    public function getType()
    {
        return $this->type;
    }
}
