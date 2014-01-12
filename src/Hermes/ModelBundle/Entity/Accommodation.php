<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Accommodation
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\OneToMany(targetEntity="Service", mappedBy="accommodation")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity="Trip", inversedBy="accommodation")
     * @ORM\JoinColumn(name="trip_id", referencedColumnName="id", nullable=false)
     */
    private $trip;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add services
     *
     * @param \Hermes\ModelBundle\Entity\Service $services
     * @return Accommodation
     */
    public function addService(\Hermes\ModelBundle\Entity\Service $services)
    {
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \Hermes\ModelBundle\Entity\Service $services
     */
    public function removeService(\Hermes\ModelBundle\Entity\Service $services)
    {
        $this->services->removeElement($services);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set trip
     *
     * @param \Hermes\ModelBundle\Entity\Trip $trip
     * @return Accommodation
     */
    public function setTrip(\Hermes\ModelBundle\Entity\Trip $trip)
    {
        $this->trip = $trip;

        return $this;
    }

    /**
     * Get trip
     *
     * @return \Hermes\ModelBundle\Entity\Trip 
     */
    public function getTrip()
    {
        return $this->trip;
    }
}
