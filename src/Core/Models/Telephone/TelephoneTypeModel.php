<?php

namespace Core\Models\Telephone;

use Doctrine\ORM\Mapping as ORM;

/**
 * TelephoneTypeModel
 * ---------------------
 * date 2015-09-17
 * 
 * @ORM\Entity(repositoryClass="Core\Models\Telephone\TelephoneTypeRepository")
 * @ORM\Table(name="telephone_types")
 */
class TelephoneTypeModel
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="type", type="string")
	 */
	private $type;

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
     * Set type
     *
     * @param string $type
     *
     * @return TelephoneTypeModel
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
