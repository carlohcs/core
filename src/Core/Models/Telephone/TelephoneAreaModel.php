<?php

namespace Core\Models\Telephone;

use Doctrine\ORM\Mapping as ORM;

/**
 * TelephoneAreaModel
 * ---------------------
 * date 2015-09-17
 * 
 * @ORM\Entity(repositoryClass="Core\Models\Telephone\TelephoneAreaRepository")
 * @ORM\Table(name="telephone_areas")
 */
class TelephoneAreaModel
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
	private $area;

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
     * Set area
     *
     * @param string $area
     *
     * @return TelephoneAreaModel
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }
}
