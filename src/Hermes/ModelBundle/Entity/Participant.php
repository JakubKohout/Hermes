<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Participant
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
    private $first_name;

    /** 
     * @ORM\Column(type="string", nullable=true)
     */
    private $last_name;

    /** 
     * @ORM\Column(type="string", nullable=true)
     */
    private $personal_number;

    /** 
     * @ORM\OneToMany(targetEntity="Service", mappedBy="Participant")
     */
    private $services;

    /**
     * @ORM\ManyToMany(targetEntity="Contract", mappedBy="Participant")
     */
    private $contracts;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contracts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Participant
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
     * Set first_name
     *
     * @param string $firstName
     * @return Participant
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Participant
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set personal_number
     *
     * @param string $personalNumber
     * @return Participant
     */
    public function setPersonalNumber($personalNumber)
    {
        $this->personal_number = $personalNumber;

        return $this;
    }

    /**
     * Get personal_number
     *
     * @return string 
     */
    public function getPersonalNumber()
    {
        return $this->personal_number;
    }

    /**
     * Add services
     *
     * @param \Hermes\ModelBundle\Entity\Service $services
     * @return Participant
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
     * Add contracts
     *
     * @param \Hermes\ModelBundle\Entity\Contract $contracts
     * @return Participant
     */
    public function addContract(\Hermes\ModelBundle\Entity\Contract $contracts)
    {
        $this->contracts[] = $contracts;

        return $this;
    }

    /**
     * Remove contracts
     *
     * @param \Hermes\ModelBundle\Entity\Contract $contracts
     */
    public function removeContract(\Hermes\ModelBundle\Entity\Contract $contracts)
    {
        $this->contracts->removeElement($contracts);
    }

    /**
     * Get contracts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContracts()
    {
        return $this->contracts;
    }
}
