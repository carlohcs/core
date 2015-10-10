<?php

namespace Core\Models\Account;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AccountModel
 * ---------------------
 * date 2015-09-15
 * 
 * @ORM\Entity(repositoryClass="Core\Models\Account\AccountRepository")
 * @ORM\Table(name="accounts")
 */
class AccountModel
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="name", type="string")
	 */
	private $name;

	/**
	 * @ORM\Column(name="nickname", type="string")
	 */
	private $nickname;
	
	/**
	 * @ORM\Column(name="login", type="string")
	 */
	private $login;
	
	/**
	 * @ORM\Column(name="password", type="string")
	 */
	private $password;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active = 1;

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
     * @ORM\OneToMany(targetEntity="\Core\Models\Email\EmailModel", mappedBy="account", cascade={"all"})
     */
    private $emails;

    /**
     * @ORM\OneToMany(targetEntity="\Core\Models\Telephone\TelephoneModel", mappedBy="account", cascade={"all"})
     */
    private $telephones;

    /**
     * @ORM\OneToMany(targetEntity="\Core\Models\Address\AddressModel", mappedBy="account", cascade={"all"})
     */
    private $address;

    /**
     * @ORM\OneToOne(targetEntity="\Core\Models\Avatar\AvatarModel", mappedBy="account", cascade={"all"}))
     */
    private $avatar;

    /**
     * Constructor
     */
    public function __construct()
    {
        //Define the date create
        $this->createdAt = new \DateTime('now');
        $this->emails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->telephones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->address = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return AccountModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return AccountModel
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return AccountModel
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return AccountModel
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return AccountModel
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return AccountModel
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
     * Add email
     *
     * @param \Core\Models\Email\EmailModel $email
     *
     * @return AccountModel
     */
    public function addEmail(\Core\Models\Email\EmailModel $email)
    {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * Remove email
     *
     * @param \Core\Models\Email\EmailModel $email
     */
    public function removeEmail(\Core\Models\Email\EmailModel $email)
    {
        $this->emails->removeElement($email);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Add telephone
     *
     * @param \Core\Models\Telephone\TelephoneModel $telephone
     *
     * @return AccountModel
     */
    public function addTelephone(\Core\Models\Telephone\TelephoneModel $telephone)
    {
        $this->telephones[] = $telephone;

        return $this;
    }

    /**
     * Remove telephone
     *
     * @param \Core\Models\Telephone\TelephoneModel $telephone
     */
    public function removeTelephone(\Core\Models\Telephone\TelephoneModel $telephone)
    {
        $this->telephones->removeElement($telephone);
    }

    /**
     * Get telephones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTelephones()
    {
        return $this->telephones;
    }

    /**
     * Add address
     *
     * @param \Core\Models\Address\AddressModel $address
     *
     * @return AccountModel
     */
    public function addAddress(\Core\Models\Address\AddressModel $address)
    {
        $this->address[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Core\Models\Address\AddressModel $address
     */
    public function removeAddress(\Core\Models\Address\AddressModel $address)
    {
        $this->address->removeElement($address);
    }

    /**
     * Get address
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set avatar
     *
     * @param \Core\Models\Avatar\AvatarModel $avatar
     *
     * @return AccountModel
     */
    public function setAvatar(\Core\Models\Avatar\AvatarModel $avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \Core\Models\Avatar\AvatarModel
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
