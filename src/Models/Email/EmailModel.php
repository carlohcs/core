<?php

namespace Carlohcs\Core\Models\Email;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailModel
 * ---------------------
 * date 2015-09-17
 * 
 * @ORM\Entity(repositoryClass="\Carlohcs\Core\Models\Email\EmailRepository")
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
     * @ORM\ManyToOne(targetEntity="\Carlohcs\Core\Models\Account\AccountModel", inversedBy="emails")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     *
     */
    private $account;

	// ==================================================================
	//
	// Constructor
	//
	// ------------------------------------------------------------------
	public function __construct(){

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
     * @param \Carlohcs\Core\Models\Account\AccountModel $account
     *
     * @return EmailModel
     */
    public function setAccount(\Carlohcs\Core\Models\Account\AccountModel $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Carlohcs\Core\Models\Account\AccountModel
     */
    public function getAccount()
    {
        return $this->account;
    }
}
