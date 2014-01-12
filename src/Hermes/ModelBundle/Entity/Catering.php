<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Catering
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /** 
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /** 
     * @ORM\OneToMany(targetEntity="Service", mappedBy="Catering")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity="Trip", inversedBy="Catering")
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
     * Set id
     *
     * @param integer $id
     * @return Catering
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
     * @return Catering
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
     * Set description
     *
     * @param string $description
     * @return Catering
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add services
     *
     * @param \Hermes\ModelBundle\Entity\Service $services
     * @return Catering
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
     * @return Catering
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
