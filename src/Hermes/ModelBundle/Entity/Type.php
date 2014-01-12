<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Type
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /** 
     * @ORM\Column(nullable=true)
     */
    private $name;

    /** 
     * @ORM\OneToMany(targetEntity="Trip", mappedBy="Type")
     */
    private $trips;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trips = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Type
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
     * Set name
     *
     * @param string $name
     * @return Type
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
     * Add trips
     *
     * @param \Hermes\ModelBundle\Entity\Trip $trips
     * @return Type
     */
    public function addTrip(\Hermes\ModelBundle\Entity\Trip $trips)
    {
        $this->trips[] = $trips;

        return $this;
    }

    /**
     * Remove trips
     *
     * @param \Hermes\ModelBundle\Entity\Trip $trips
     */
    public function removeTrip(\Hermes\ModelBundle\Entity\Trip $trips)
    {
        $this->trips->removeElement($trips);
    }

    /**
     * Get trips
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrips()
    {
        return $this->trips;
    }
}
