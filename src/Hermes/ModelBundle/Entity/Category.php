<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Category
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /** 
     * @ORM\OneToMany(targetEntity="Trip", mappedBy="Category")
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add trips
     *
     * @param \Hermes\ModelBundle\Entity\Trip $trips
     * @return Category
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
