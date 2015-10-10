<?php

namespace Core\Models\Avatar;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AvatarModel
 * ---------------------
 * date 2015-09-21
 * 
 * @ORM\Entity(repositoryClass="Core\Models\Avatar\AvatarRepository")
 * @ORM\Table(name="avatars")
 */
class AvatarModel
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="avatar", type="string")
	 */
	private $avatar;

    /**
     * @ORM\Column(name="thumbnail", type="string")
     */
    private $thumbnail;

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
     * @ORM\OneToOne(
     * targetEntity="\Core\Models\Account\AccountModel", inversedBy="avatar", cascade={"all"}),
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    private $account;
	
    // ==================================================================
    //
    // Constructor
    //
    // ------------------------------------------------------------------
    public function __construct()
    {
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
     * Set avatar
     *
     * @param string $avatar
     *
     * @return AvatarModel
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return AvatarModel
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
     * @return AvatarModel
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
     * @return AvatarModel
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
     * Set thumbnail
     *
     * @param string $thumbnail
     *
     * @return AvatarModel
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
}
